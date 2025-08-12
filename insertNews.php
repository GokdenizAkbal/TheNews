<?php

$link = mysqli_connect("localhost", "root", "12345*678", "news_portal");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "INSERT INTO news (title, description, image_path, author, publish_date, card_type, tags) VALUES
-- cardAll.php news (6 quantity)
('Bill Walsh leadership lessons', 'Like to know the secrets of transforming a 2-14 team into a 3x Super Bowl winning Dynasty?', 'Images/Mountain.png', 'Alec Whitten', '2023-01-01', 'small', 'leadership,management,presentation'),
('PM mental models', 'Mental models are simple expressions of complex processes or relationships.', 'Images/Models.png', 'Demi Wilkinson', '2023-01-01', 'small', 'product,research,frameworks'),
('What is Wireframing?', 'Introduction to Wireframing and its Principles. Learn from the best in the industry.', 'Images/WireFrame.png', 'Candice Wu', '2023-01-01', 'small', 'design,research,presentation'),
('How collaboration makes us better designers', 'Collaboration can make our teams stronger, and our individual designs better.', 'Images/Colloboration.png', 'Natali Craig', '2023-01-01', 'small', 'design,research,presentation'),
('Our top 10 Javascript frameworks to use', 'JavaScript frameworks make development easy with extensive features and functionalities..', 'Images/Framework.png', 'Drew Cano', '2023-01-01', 'small', 'softwareDevelopment,tools,saas'),
('Podcast: Creating a better CX Community', 'Starting a community doesn’t need to be complicated, but how do you get started?', 'Images/Podcast.png', 'Orlando Diggs', '2023-01-01', 'small', 'podcasts,customerSuccess,presentation'),

-- card.php news (4 quantity)
('UX Review Presentation', 'How do you create compelling presentations that wow your colleagues and impress your managers?', 'Images/Review.png', 'Olivia Rhye', '2023-01-01', 'large', 'design,research,presentation'),
('Migrating to Linear 101', 'Linear helps streamline software projects, sprints, tasks, and bug tracking. Here’s how to get started...', 'Images/Migration.png', 'Phoenix Baker', '2023-01-01', 'small', 'design,research'),
('Building your API Stack', 'The rise of RESTful APIs has been met by a rise in tools for creating, testing, and managing them...', 'Images/Api.png', 'Lana Steiner', '2023-01-01', 'small', 'design,research'),
('Grid system for better Design User Interface', 'A grid system is a design tool used to arrange content on a webpage. It is a series of vertical and horizontal lines...', 'Images/Climate.png', 'Olivia Rhye', '2023-01-01', 'large', 'design,interface');
";

if (mysqli_query($link, $sql)) {
    echo "OK";
} else {
    http_response_code(500);
    echo "Database error: " . mysqli_error($link);
}


mysqli_close($link);


?>