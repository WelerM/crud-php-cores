<?php

namespace core\models;

use core\classes\Database;

use Exception;
use stdClass;

class User
{

    public function list_users()
    {
        $db = new Database();

        $user = $db->select(
            "SELECT 
                users.id,
                users.name,
                users.email,
                GROUP_CONCAT(colors.name) AS colors
            FROM
                users
            LEFT JOIN
                user_colors
            ON
                users.id = user_colors.user_id
            LEFT JOIN
                colors
            ON
                user_colors.color_id = colors.id
            GROUP BY
                users.id
            ORDER BY
                users.id DESC"
        );
    
        // Set the result
        $result = json_decode(json_encode($user), true);
    
        // Define the desired order of colors
        $correct_color_order = ['blue', 'red', 'yellow', 'green'];
    
        // Convert 'colors' from a comma-separated string to an array
        foreach ($result as &$user) {
            $colors = explode(',', strtolower($user['colors'])); // Convert to lowercase to ensure case-insensitive comparison
            $orderedColors = [];
    
            // Reorder colors according to the desired order
            foreach ($correct_color_order as $color) {
                if (in_array($color, $colors)) {
                    $orderedColors[] = ucfirst($color); // Capitalize the first letter
                }
            }
    
            // Set the ordered colors
            $user['colors'] = $orderedColors;
        }
    
        return $result;
    }
    //======================================

    public function show_user($id)
    {

        $params = [
            ':id' => trim($id)
        ];

        $db = new Database();

        $result = $db->select(
            "SELECT 
                users.id,
                users.name,
                users.email,
                GROUP_CONCAT(colors.name) AS colors
            FROM
                users
            LEFT JOIN
                user_colors
            ON
                users.id = user_colors.user_id
            LEFT JOIN
                colors
            ON
                user_colors.color_id = colors.id
             WHERE
                users.id = :id
            GROUP BY
                users.id",
            $params
        );

        $result = json_decode(json_encode($result), true);


        // Convert 'colors' from a comma-separated string to an array
        foreach ($result as &$user) {
            $user['colors'] = explode(',', $user['colors']);
        }

        return $result;

    }
    //======================================

    public function list_colors()
    {

        $db = new Database();

        // Fetch the color data as objects
        $colors = $db->select(
            "SELECT 
                name
            FROM
                 colors"
        );

        // Convert the array of stdClass objects to an array of associative arrays
        $colorsArray = json_decode(json_encode($colors), true);

        // Extract the color names into a simple array of strings
        $result = array_map(function ($color) {
            return $color['name'];
        }, $colorsArray);

        return $result;
    }
    //======================================

    public function list_user_colors($id)
    {

        $db = new Database();
        $params = [
            ':id' => trim($id)
        ];
        $base_colors = ['Blue', 'Red', 'Yellow', 'Green'];
        $user_colors = [];
        $result_array = [];
        $obj = new stdClass;

        //Searches for user's current attached colors 
        $result = $db->select(
            "SELECT id, name FROM
                colors
            JOIN
                user_colors
            ON
                colors.id = user_colors.color_id
            WHERE
                user_colors.user_id = :id",
            $params
        );

        //Array containing all user's attached colors
        $user_colors = json_decode(json_encode($result), true);



        // - Creates 4 index array for final result 
        // -Each index of the array will be another array
        //  Containing two positions:
        //  - [color] for the actual color name
        //  - [checked] responsible for setting or not input-checks to On in the view

        for ($i = 0; $i < count($base_colors); $i++) {
            
            $bootstrap_classes = ['primary', 'danger', 'warning', 'success'];
    
            $obj->color = $base_colors[$i];
            $obj->checked = false;  //For input-check   
            $obj->bg_color = $bootstrap_classes[$i];//For bootstrap
    
            $result_array[] = $obj;
            $result_array = json_decode(json_encode($result_array), true);
        }


        //Compares each user's color to every index of $result_array.
        //If both values matches, the 'checked' position of each index of the
        //$result_array will be set to true, indicating to the view that
        //some of the input-checks will be set as On, which will be the
        //colors that the user currently have set to themselves in the database.

        for ($i = 0; $i < count($user_colors); $i++) {


            if (in_array($user_colors[$i]['name'], $base_colors)) {


                if ($user_colors[$i]['name'] === 'Blue') {

                    $result_array[0]['checked'] = true;

                } else if ($user_colors[$i]['name'] === 'Red') {

                    $result_array[1]['checked'] = true;

                } else if ($user_colors[$i]['name'] === 'Yellow') {

                    $result_array[2]['checked'] = true;

                } else if ($user_colors[$i]['name'] === 'Green') {
                    $result_array[3]['checked'] = true;

                }
            }
        }

        return $result_array;

    }
    //======================================


    public function update_color($user_id, $user_choosen_colors)
    {
        $db = new Database();

        //Verifies if the user has colors attached to them in the database
        $params = [
            ':user_id' => $user_id
        ];
        $result = $db->select(
            "SELECT color_id FROM user_colors WHERE user_id = :user_id",
            $params
        );

        $user_db_colors = [];
        if ($result) {
            $user_db_colors = array_column($result, 'color_id');
        }

        //Converts to integer values so it can make the correct comparasion
        $user_choosen_colors = array_map('intval', $user_choosen_colors);


        //If the aren't choosen colors in the view, but there are colors in the database, removes all
        if (empty($user_choosen_colors) && !empty($user_db_colors)) {
            $params = [':user_id' => $user_id];
            $db->delete(
                "DELETE FROM user_colors WHERE user_id = :user_id",
                $params
            );
            return true;
        }


        //If there are choosen colors in the view, we make the correct comparisions
        if (!empty($user_choosen_colors)) {
            $colors_to_add = array_diff($user_choosen_colors, $user_db_colors);
            $colors_to_remove = array_diff($user_db_colors, $user_choosen_colors);


            //Adds new colors to the database
            foreach ($colors_to_add as $color_id) {
                $params = [
                    ':user_id' => $user_id,
                    ':color_id' => $color_id
                ];
                $db->insert(
                    "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)",
                    $params
                );
            }

            //Removes colors that aren't in the choosen list anymore
            foreach ($colors_to_remove as $color_id) {
                $params = [
                    ':user_id' => $user_id,
                    ':color_id' => $color_id
                ];
                $db->delete(
                    "DELETE FROM user_colors WHERE user_id = :user_id AND color_id = :color_id",
                    $params
                );
            }

            return true;
        }

        return "Houve um erro ao editar as cores.";
    }
    //======================================


    public function update_user($id, $name, $email)
    {

        try {

            $db = new Database();


            //Check if email exists in database
            $params = [
                ':id' => $id,
                ':email' => $email
            ];

            $result = $db->select(
                "SELECT * FROM
                users
            WHERE
                users.email = :email
            AND
                users.id != :id",
                $params
            );
            if (count($result) > 0) {
                return 'Email ja existe';
            }
            //------------------------------------------


            //Proceeds to update user name and email
            $params = [
                ':id' => $id,
                ':name' => $name,
                ':email' => $email
            ];

            $db->update(
                "UPDATE
                    users
                SET
                    users.name = :name,
                    users.email = :email
                WHERE
                    users.id = :id",
                $params
            );

            return true;


        } catch (Exception $e) {
            return 'Houve um erro ao editar o nome ou email do usuário';
        }
    }
    //======================================


    public function create_user($name, $email, $arr_colors)
    {
        $db = new Database();

        //Check if email exists in database
        $params = [
            ':email' => $email
        ];

        $result = $db->select(
            "SELECT * FROM
                users
            WHERE
                users.email = :email",
            $params
        );
        if (count($result) > 0) {
            return 'Email ja existe';
        }
        //-----------------------------------------



        //Insert new user into the database and
        //retrieves their id

        $params = [
            ':name' => $name,
            ':email' => $email
        ];

        $last_user_id = $db->insert(
            "INSERT INTO
                users
            VALUES(
              0,
                :name,
                :email
            )",
            $params
        );

        //-----------------------------------------


        //Insert user colors into the database
        //Check if any color was choosen
        if (count($arr_colors) > 0) {

            foreach ($arr_colors as $color) {

                $params = [
                    ':color_id' => $color,
                    ':user_id' => $last_user_id
                ];

                $db->insert(
                    "INSERT INTO
                         user_colors
                    VALUES(
                        :color_id,
                        :user_id
                    )",
                    $params
                );
            }

        }

        return true;

    }
    //======================================


    public function delete_user($id)
    {
        $db = new Database();
        $params = [
            ':id' => $id
        ];

        //Delete register from 'users' table
        try {

            $db->delete(
                "DELETE FROM 
                    users
                WHERE
                    users.id = :id",
                $params
            );

        } catch (Exception $e) {

            return false;
        }




        //Delete register from 'user_colors' table
        try {

            $db->delete(
                "DELETE FROM 
                    user_colors
                WHERE
                    user_colors.user_id = :id",
                $params
            );


        } catch (Exception $e) {

            return false;
        }


        return true;

    }    //======================================

}
