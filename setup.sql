CREATE DATABASE IF NOT EXISTS cinestream CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cinestream;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    genre VARCHAR(100) NOT NULL,
    thumbnail VARCHAR(255) DEFAULT NULL,
    video_path VARCHAR(255) DEFAULT NULL,
    description TEXT,
    release_year YEAR NOT NULL
);

CREATE TABLE IF NOT EXISTS my_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (content_id) REFERENCES content(id) ON DELETE CASCADE,
    UNIQUE KEY unique_list (user_id, content_id)
);

CREATE TABLE IF NOT EXISTS history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content_id INT NOT NULL,
    watched_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (content_id) REFERENCES content(id) ON DELETE CASCADE
);

INSERT INTO content (id, title, genre, description, release_year, thumbnail, video_path) VALUES

-- Animation
(1, 'Zootopia 2', 'Animation', 'Judy and Nick return to uncover a new conspiracy threatening the animal city they worked so hard to protect', 2025, 'images/zootopia2.png', 'videos/zootopia2.mp4'),
(2, 'The Lion King', 'Animation', 'A young lion prince flees his kingdom after the murder of his father, only to return years later to reclaim what is rightfully his', 1994, 'images/lion king.jpeg', 'videos/lion king.mp4'),
(3, 'Coco', 'Animation', 'A young boy travels to the Land of the Dead to uncover the truth about his family''s mysterious ban on music', 2017, 'images/coco.jpeg', 'videos/coco.mp4'),
(4, 'Luca', 'Animation', 'A sea monster boy discovers friendship and adventure during a summer on the Italian Riviera while hiding his true identity', 2021, 'images/luca.jpeg', 'videos/luca.mp4'),
(5, 'Luck', 'Animation', 'The unluckiest girl in the world stumbles into the Land of Luck and must unite with magical creatures to fix the chaos she caused', 2022, 'images/lucl.jpeg', 'videos/luck.mp4'),
(6, 'Elemental', 'Animation', 'In a city where fire, water, land, and air residents coexist, a fiery young woman and a go-with-the-flow guy discover something unexpected between them', 2023, 'images/elemental.jpeg', 'videos/elemental.mp4'),
(7, 'Onward', 'Animation', 'Two elf brothers embark on a magical quest to spend one last day with their late father using a broken wizard staff', 2020, 'images/onward.jpeg', 'videos/onward.mp4'),
(8, 'Toy Story 5', 'Animation', 'Woody, Buzz and the gang face a whole new world of challenges as the toys navigate a rapidly changing world without Andy', 2026, 'images/toy story 5.jpeg', 'videos/toy story 5.mp4'),
(9, 'Big Hero 6', 'Animation', 'A young robotics prodigy and his inflatable robot Baymax join a team of unlikely heroes to uncover a criminal plot in the futuristic city of San Fransokyo', 2014, 'images/Big hero 6.jpeg', 'videos/big hero 6.mp4'),
(10, 'Encanto', 'Animation', 'A Colombian girl discovers she is the only member of her magical family without a gift, yet may hold the key to saving everything they love', 2021, 'images/enchanto.jpeg', 'videos/enchanto.mp4'),

-- Action
(11, 'The Mummy', 'Action', 'An adventurer accidentally awakens an ancient mummy while on an expedition in Egypt', 1999, 'images/the mummy.jpg', 'videos/the mummy.mp4'),
(12, 'Casablanca Express', 'Action', 'A thrilling action film set during wartime involving a train heist and espionage', 1990, 'images/Casablanca express.jpg', 'videos/Casablanca express.mp4'),
(13, 'Mad Max: Fury Road', 'Action', 'A post-apocalyptic chase across a desert wasteland between a tyrant and his escaped captive', 2015, 'images/mad max.jpg', 'videos/mad max.mp4'),
(14, 'El-Gezira', 'Action', 'An Egyptian crime action film about a powerful fugitive who rules a remote island', 2007, 'images/El-Gezira.jpg', 'videos/El-Gezira.mp4'),
(15, 'John Wick', 'Action', 'A retired hitman seeks vengeance against the gangsters who killed his dog', 2014, 'images/John Wick.jpg', 'videos/John Wick.mp4'),
(16, 'Harb Karmouz', 'Action', 'An action-packed Egyptian film depicting a battle in the streets of Alexandria', 2018, 'images/Harb Karmouz.jpg', 'videos/Harb Karmouz.mp4'),
(17, 'Die Hard', 'Action', 'A New York cop battles terrorists who have taken over a Los Angeles skyscraper', 1988, 'images/Die Hard.webp', 'videos/Die Hard.mp4'),
(18, 'Wahed Saheh', 'Action', 'A gripping Egyptian thriller involving corruption and street justice', 2011, 'images/Wahed Saheh.jpg', 'videos/Wahed Saheh.mp4'),
(19, 'Mission: Impossible – Fallout', 'Action', 'Ethan Hunt and his team race against time to prevent a global catastrophe', 2018, 'images/Mission impossible.jpg', 'videos/Mission impossible.mp4'),
(20, 'Elkhalia', 'Action', 'The Cell is an Egyptian action thriller that follows a dedicated special operations officer...', 2017, 'images/Elkhalia.jpg', 'videos/Elkhalia.mp4'),

-- Drama
(21, 'The Intouchables', 'Drama', 'An unlikely friendship between a wealthy quadriplegic and his street-smart caregiver', 2011, 'images/The Intouchables.jpg', 'videos/The Intouchables.mp4'),
(22, 'Elkenz', 'Drama', 'Treasure hunting across different historical timelines in Egypt.', 2017, 'images/Elkenz.jpg', 'videos/Elkenz.mp4'),
(23, 'The Shawshank Redemption', 'Drama', 'Two imprisoned men bond over years finding solace and eventual redemption', 1994, 'images/The Shawshank Redemption.jpg', 'videos/The Shawshank Redemption.mp4'),
(24, 'The Blue Elephant', 'Drama', 'The Blue Elephant is an Egyptian psychological drama that follows a psychiatrist...', 2014, 'images/The Blue Elephant.jpg', 'videos/The Blue Elephant.mp4'),
(25, 'Schindler''s List', 'Drama', 'A German businessman saves over a thousand Polish Jews during the Holocaust', 1993, 'images/Schindler''s List.webp', 'videos/Schindler''s List.mp4'),
(26, 'Mousa', 'Drama', 'A young inventor creates a robot that changes his life.', 2021, 'images/Mousa.jpg', 'videos/Mousa.mp4'),
(27, 'Parasite', 'Drama', 'A poor family schemes to become employed by a wealthy family with unexpected consequences', 2019, 'images/Parasite.webp', 'videos/Parasite.mp4'),
(28, 'Kira & El Gin', 'Drama', 'Kira & El Gin is an Egyptian historical drama set during the 1919 revolution against British occupation...', 2022, 'images/Kira & El Gin.jpg', 'videos/Kira & El Gin.mp4'),
(29, 'Forrest Gump', 'Drama', 'The life journey of a kind-hearted man with low IQ who witnesses key American historical events', 1994, 'images/Forrest Gump.jpg', 'videos/Forrest Gump.mp4'),
(30, 'Yacoubian Building', 'Drama', 'An ensemble drama exploring the lives of residents in a famous Cairo apartment building', 2006, 'images/Yacoubian Building.jpg', 'videos/Yacoubian Building.mp4'),

-- Comedy
(31, 'El Harifa', 'Comedy', 'A sports-comedy drama about a talented street football player who rises from local matches...', 2024, 'images/El Harifa.jpg', 'videos/El Harifa.mp4'),
(32, 'El-Lemby', 'Comedy', 'A hugely popular Egyptian comedy following the misadventures of a street-smart young man', 2002, 'images/El-Lemby.jpg', 'videos/El-Lemby.mp4'),
(33, 'The Grand Budapest Hotel', 'Comedy', 'A legendary hotel concierge and his lobby boy get entangled in theft and murder mystery', 2014, 'images/The Grand Budapest Hotel.webp', 'videos/The Grand Budapest Hotel.mp4'),
(34, 'El Badla', 'Comedy', 'A comedy about two friends who discover a mysterious device that allows them to switch bodies...', 2018, 'images/El Badla.jpg', 'videos/El Badla.mp4'),
(35, 'Superbad', 'Comedy', 'Two inseparable best friends try to make the most of their last days before graduating', 2007, 'images/Superbad.jpg', 'videos/Superbad.mp4'),
(36, 'Tisbah Ala Khair', 'Comedy', 'A dark comedy about a wealthy businessman who finds himself stuck in a strange cycle of waking up...', 2017, 'images/Tisbah Ala Khair.jpg', 'videos/Tisbah Ala Khair.mp4'),
(37, 'Bank El Haz', 'Comedy', 'A comedy that follows a group of misfits who plan a risky bank heist...', 2017, 'images/Bank El Haz.jpg', 'videos/Bank El Haz.mp4'),
(38, 'El Nazer', 'Comedy', 'Comedy about a corrupt school principal and his chaotic life inside the education system.', 2000, 'images/El Nazer.jpg', 'videos/El Nazer.mp4'),
(39, 'Zaki Chan', 'Comedy', 'A shy man transforms his life to become more confident and successful.', 2005, 'images/Zaki Chan.jpg', 'videos/Zaki Chan.mp4'),
(40, 'Keda Reda', 'Comedy', 'Three identical brothers with different personalities create chaos in love and life', 2007, 'images/Keda Reda.jpg', 'videos/Keda Reda.mp4');