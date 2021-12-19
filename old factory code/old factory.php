<?php
// steps to get this script to work with the assignment
/*
sudo apt-get update
sudo apt-get composer
mkdir assignment
cd assignment
composer require fzaninotto/faker
php index.php
 */
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();

// Create connection
$conn = new SQLite3('./test/lite.db');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";

//gender populate
$male = "INSERT INTO genders ( name)
VALUES ('male')";
$female = "INSERT INTO genders ( name)
VALUES ('female')";

if ($conn->query($male) === true) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $male . "<br>" . $conn->error . "<br>";
}

// populate users
for ($i = 0; $i < 5; $i++) {

    $gender_id = $faker->numberBetween(1, 2);
    $first_name = $gender_id == 1 ? $faker->firstNameMale() : $faker->firstNameFemale();
    $last_name = $faker->lastName();
    $username = $faker->username();
    $email = $faker->email();
    $password = $faker->password();
    $birth_date = $faker->date();
    $adress = $faker->address();
    $bio = $faker->text($maxNbChars = 500);
//query
    $userQuery = "INSERT INTO users ( gender_id , first_name , last_name ,username ,email,password, birth_date,   adress ,bio)VALUES ( '$gender_id' , '$first_name' , '$lastName' ,'$username' , '$email' ,'$password' , '$birth_date','$adress' , '$bio'  ) ";
//connection
    if ($conn->query($userQuery) === true) {
        echo "<br> $userQuery<br>";
    } else {
        echo "Error: " . $userQuery . "<br>" . $conn->error . "<br>";
    }

}

//populate posts
for ($i = 0; $i < 15; $i++) {
    $user_id = $faker->numberBetween(1, 5);
    $comment = $faker->text($maxNbChars = 1000);
    $postsQuery = "INSERT INTO posts (comment , user_id)
VALUES ('$comment' , '$user_id' ) ";
//connection
    if ($conn->query($postsQuery) === true) {
        echo "<br> $postsQuery<br>";
    } else {
        echo "Error: " . $postsQuery . "<br>" . $conn->error . "<br>";
    }
}

//populate likes
for ($i = 0; $i < 15; $i++) {
    $user_id = $faker->numberBetween(1, 5);
    $post_id = $faker->numberBetween(1, 15);
    $likesQuery = "INSERT INTO likes (user_id , post_id)
VALUES ('$user_id', '$post_id' ) ";
//connection
    if ($conn->query($likesQuery) === true) {
        echo "<br> $likesQuery<br>";
    } else {
        echo "Error: " . $likesQuery . "<br>" . $conn->error . "<br>";
    }
}


//populate comments
for ($i = 0; $i < 15; $i++) {
    $user_id = $faker->numberBetween(1, 5);
    $post_id = $faker->numberBetween(1, 15);
    $content = $faker->text($maxNbChars = 1000);
    $commentsQuery = "INSERT INTO comments (user_id , post_id ,content)
VALUES ($user_id, '$post_id' ,  '$content' ) ";
//connection
    if ($conn->query($commentsQuery) === true) {
        echo "<br> $commentsQuery<br>";
    } else {
        echo "Error: " . $commentsQuery . "<br>" . $conn->error . "<br>";
    }
}


//populate chats
for ($i = 0; $i < 15; $i++) {
    $to_user_id = $faker->numberBetween(1, 5);
    $from_user_id = $faker->numberBetween(1, 15);
    $message = $faker->text($maxNbChars = 1000);
    $chatsQuery = "INSERT INTO chats (to_user_id , from_user_id ,message)
VALUES ('$to_user_id', '$from_user_id' ,  '$message' ) ";
//connection
    if ($conn->query($chatsQuery) === true) {
        echo "<br> $chatsQuery<br>";
    } else {
        echo "Error: " . $chatsQuery . "<br>" . $conn->error . "<br>";
    }
}


$conn->close();

