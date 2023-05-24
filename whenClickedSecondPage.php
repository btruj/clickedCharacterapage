<?php
$id = $_GET['id'];
$params = ['apikey' => '4eda7fae5265f683474bbb6d8c041c3a'];
$params_string = http_build_query($params);
//////////////////////////////////////////////////////////
// cURL for character
// Initialize cURL
$ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, 'https://gateway.marvel.com:443/v1/public/characters/' . $id . '?' . $params_string);
// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Referer: developer.marvel.com',
]);
// Get the data from the API
$response = curl_exec($ch);
// stop if fails
if (!$response) {
    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}
// Close the cURL resource
curl_close($ch);
// Return the decoded response
$character = json_decode($response)->data->results[0];
//////////////////////////////////////////////////////////
// cURL for comics
// Initialize cURL
$ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, 'https://gateway.marvel.com:443/v1/public/characters/' . $id . '/comics?' . $params_string);
// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Referer: developer.marvel.com',
]);
// Get the data from the API
$responseComics = curl_exec($ch);
// stop if fails
if (!$responseComics) {
    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}
// Close the cURL resource
curl_close($ch);
// Return the decoded response
$charactersComics = json_decode($responseComics)->data;
//////////////////////////////////////////////////////////
// cURL for events
// Initialize cURL
$ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, 'https://gateway.marvel.com:443/v1/public/characters/' . $id . '/events?' . $params_string);
// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Referer: developer.marvel.com',
]);
// Get the data from the API
$responseEvents = curl_exec($ch);
// stop if fails
if (!$responseEvents) {
    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}
// Close the cURL resource 
curl_close($ch);
// Return the decoded response
$charactersEvents = json_decode($responseEvents)->data;
////////////////////////////////////////////////////////////
// cURL for series
// Initialize cURL
$ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, 'https://gateway.marvel.com:443/v1/public/characters/' . $id . '/series?' . $params_string);
// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Referer: developer.marvel.com',
]);
// Get the data from the API
$responseSeries = curl_exec($ch);
// stop if fails
if (!$responseSeries) {
    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}
// Close the cURL resource
curl_close($ch);
// Return the decoded response
$charactersSeries = json_decode($responseSeries)->data;
/////////////////////////////////////////////////////////
// cURL for stories
// Initialize cURL
$ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, 'https://gateway.marvel.com:443/v1/public/characters/' . $id . '/stories?' . $params_string);
// set method
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// set headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Referer: developer.marvel.com',
]);
// Get the data from the API
$responseStories = curl_exec($ch);
// stop if fails
if (!$responseStories) {
    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}
// Close the cURL resource
curl_close($ch);
// Return the decoded response
$characterStories = json_decode($responseStories)->data;
//////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $character->name; ?></title>
    <style>
        body,
        html {
            letter-spacing: 2px;
            background-color: #181818;
            color: #ffffff;
            font-family: 'Fakt Soft Pro';
            padding: 20px;
        }

        h1 {
            width: fit-content;
            padding: 15px;
            font-size: 2em;
            font-weight: 700;
            text-align: center;
            margin: 0 auto;
            border-bottom: #ED1D24 solid 1px;
            border-radius: 8px;
        }

        .tabs {
            display: flex;
            flex-wrap: wrap;
            border-bottom: 2px solid #ED1D24;
        }

        .tabs a {
            color: #ffffff;
            text-decoration: none;
        }

        .tabs button {
            flex: 1 1 auto;
            /* allows tabs to shrink and grow as needed */
            background-color: #181818;
            border-top: 2px solid #ED1D24; border-right: 2px solid #ED1D24;
            color: #ffffff;
            padding: 10px 10px;
            margin: 2px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .tabs button:hover {
            background-color: #ED1D24;
            color: #181818;
        }

        .container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 10px;
            padding: 20px;
        }

        .description,
        .modified {
            background-color: #ED1D24;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 10px;

        }

        .container img {
            max-width: 300px;
            border: 1px solid #444;
        }

        .text-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 60%;
        }

        img {
            max-width: 300px;
            border: 1px solid #444;
            margin-right: 20px;
        }

        span {
            background-color: #ED1D24;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            max-width: 60%;
            text-align: center;
        }

        button {
            margin-top: 10px;
            background-color: #ED1D24;
            border: none;
            color: #ffffff;
            padding: 10px 20px;
            text-transform: uppercase;
            cursor: pointer;
        }

        button:hover {
            background-color: #FF6347;
            color: #181818;
        }

        .item-container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 10px;
            padding: 20px;
        }

        .item-container img {
            max-width: 300px;
            border: 1px solid #444;
        }

        .item-description {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 60%;
        }
        h3 {
            border-bottom: 1px solid red;
            font-style: italic;
        }

        /* Media Query for mobile devices */
        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .text-container {
                max-width: 100%;
            }

            img {
                max-width: 100%;
                margin-right: 0;
            }

            span {
                max-width: 100%;
            }

            .item-container {
                flex-direction: column;
                align-items: center;
            }

            .item-description {
                max-width: 100%;
            }

            .item-container img {
                max-width: 100%;
            }

            .tabs button {
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <a href="https://bryan-dev.getuwired.ninja/marvel.php"><button class="">Back</button></a>
    <h1><?php echo $character->name; ?></h1>
    <div class="container">
        <img src="<?php echo $character->thumbnail->path . '.' . $character->thumbnail->extension; ?>" alt="Character Thumbnail">
        <div class="text-container">
            <span class="description"><u>Description</u>: <?php echo ($character->description) ? "$character->description" : "Not Provided"; ?></span>
            <?php
            $dateChange = new DateTime($character->modified);
            $newDate = $dateChange->format("Y-m-d");
            echo "<span class='last-span'><u>Modified</u>:{$newDate}</span>";
            ?>
        </div>
    </div>
    <div class="tabs">
        <a href="https://bryan-dev.getuwired.ninja/character.php?id=<?php echo $character->id; ?>&tab=comics"><button>COMICS</button></a>
        <a href="https://bryan-dev.getuwired.ninja/character.php?id=<?php echo $character->id; ?>&tab=events"><button>EVENTS</button></a>
        <a href="https://bryan-dev.getuwired.ninja/character.php?id=<?php echo $character->id; ?>&tab=series"><button>SERIES</button></a>
        <a href="https://bryan-dev.getuwired.ninja/character.php?id=<?php echo $character->id; ?>&tab=stories"><button>STORIES</button></a>
    </div>
    <div>
    <?php
// This code is about displaying data based on the tab selected on the page. 

// We start by creating an associative array called "$tabsData" that maps tab names to their corresponding data.
// For example, "comics" is mapped to "$charactersComics", "series" is mapped to "$charactersSeries" and so on.
// This mapping helps in quickly retrieving the data for a tab when it is selected.
$tabsData = [
    "comics" => $charactersComics,
    "series" => $charactersSeries,
    "stories" => $characterStories,
    "events" => $charactersEvents,
];

// We get the selected tab from the query parameters in the URL using "$_GET['tab']".
// The $_GET superglobal in PHP allows us to access data sent via HTTP GET.
$tab = $_GET['tab'];

// We check if the selected tab exists in the $tabsData array using array_key_exists(). 
// This is to prevent errors in case a non-existent tab is provided in the URL.
if (array_key_exists($tab, $tabsData)) {
    // If the tab exists, we fetch the corresponding data from $tabsData
    $data = $tabsData[$tab];

    // We then check if there's any data for the selected tab. We do this by checking if the 'count' of the data is not zero.
    // If 'count' is zero, it means there are no items to display for the selected tab.
    if ($data->count !== 0) {
        // If there are items, we loop through each item in the results using a foreach loop
        foreach ($data->results as $result) {
            // For each item, we start by opening a div for the item container
            echo '<div class="item-container">';
            // We then check if the item has a thumbnail. If it does, we concatenate the path and the extension to form the full URL of the image, 
            // and use it as the 'src' attribute in the img tag.
            if (property_exists($result, 'thumbnail') && $result->thumbnail->path && $result->thumbnail->extension) {
                echo '<img src="' . $result->thumbnail->path . '.' . $result->thumbnail->extension . '" alt="' . $result->title . '">';
            }
            // After the image, we add a title for the item inside a p tag.
            echo '<div class="item-description"><h3>' . $result->title . '</h3>';

            // If the item has a description, we add it after the title in a separate p tag.
            if ($result->description) {
                echo '<p>' . $result->description . '</p>';
            }
            // We finally close the divs for the item container and the item description
            echo '</div></div>';
        }
    } else {
        // If there are no items for the selected tab, we display a message saying "Not Provided".
        echo '<h2>Not Provided</h2>';
    }
}
?>
    </div>
</body>

</html>
