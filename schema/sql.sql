DROP TABLE IF EXISTS reviews CASCADE;
DROP TABLE IF EXISTS event_participants CASCADE;
DROP TABLE IF EXISTS articles CASCADE;
DROP TABLE IF EXISTS events CASCADE;
DROP TABLE IF EXISTS club_members CASCADE;
DROP TABLE IF EXISTS clubs CASCADE;
DROP TABLE IF EXISTS students CASCADE;

CREATE TABLE students (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL CHECK (role IN ('student', 'admin')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clubs (
    id SERIAL PRIMARY KEY,
    name VARCHAR(150) UNIQUE NOT NULL,
    description TEXT,
    president_id INT UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_president
        FOREIGN KEY (president_id)
        REFERENCES students(id)
        ON DELETE SET NULL
);

CREATE TABLE club_members (
    id SERIAL PRIMARY KEY,
    club_id INT NOT NULL,
    student_id INT UNIQUE NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_club
        FOREIGN KEY (club_id)
        REFERENCES clubs(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_student
        FOREIGN KEY (student_id)
        REFERENCES students(id)
        ON DELETE CASCADE
);

CREATE TABLE events (
    id SERIAL PRIMARY KEY,
    club_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    event_date DATE NOT NULL,
    location VARCHAR(150) NOT NULL,
    image_url TEXT, -- store only the URL of the image
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_event_club
        FOREIGN KEY (club_id)
        REFERENCES clubs(id)
        ON DELETE CASCADE
);

CREATE TABLE event_participants (
    id SERIAL PRIMARY KEY,
    event_id INT NOT NULL,
    student_id INT NOT NULL,
    participated BOOLEAN DEFAULT FALSE,

    UNIQUE (event_id, student_id),

    CONSTRAINT fk_event_participant
        FOREIGN KEY (event_id)
        REFERENCES events(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_participant_student
        FOREIGN KEY (student_id)
        REFERENCES students(id)
        ON DELETE CASCADE
);

CREATE TABLE reviews (
    id SERIAL PRIMARY KEY,
    event_id INT NOT NULL,
    student_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE (event_id, student_id),

    CONSTRAINT fk_review_event
        FOREIGN KEY (event_id)
        REFERENCES events(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_review_student
        FOREIGN KEY (student_id)
        REFERENCES students(id)
        ON DELETE CASCADE
);


CREATE TABLE articles (
    id SERIAL PRIMARY KEY,
    club_id INT NOT NULL,
    event_id INT,
    title VARCHAR(150) NOT NULL,
    content TEXT NOT NULL,
    image_url TEXT, -- store only the URL of the image
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_article_club
        FOREIGN KEY (club_id)
        REFERENCES clubs(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_article_event
        FOREIGN KEY (event_id)
        REFERENCES events(id)
        ON DELETE SET NULL
);

-- $2y$10$Z4c1CklwnZrqHup074zv0ueswxiYCipKdKEuUbWj2HRHzkyIbPuVC

-- Students
INSERT INTO students (first_name, last_name, email, password, role)
VALUES
('Alice', 'Smith', 'alice@example.com', '$2y$10$Z4c1CklwnZrqHup074zv0ueswxiYCipKdKEuUbWj2HRHzkyIbPuVC', 'student'),
('Bob', 'Johnson', 'bob@example.com', '$2y$10$Z4c1CklwnZrqHup074zv0ueswxiYCipKdKEuUbWj2HRHzkyIbPuVC', 'student'),
('Charlie', 'Brown', 'charlie@example.com', '$2y$10$Z4c1CklwnZrqHup074zv0ueswxiYCipKdKEuUbWj2HRHzkyIbPuVC', 'admin'),
('David', 'Williams', 'david@example.com', '$2y$10$Z4c1CklwnZrqHup074zv0ueswxiYCipKdKEuUbWj2HRHzkyIbPuVC', 'student');

-- Clubs
INSERT INTO clubs (name, description, president_id)
VALUES
('Science Club', 'A club for science enthusiasts', 3),
('Art Club', 'Explore your creativity with arts', NULL),
('Sports Club', 'All about sports and fitness', NULL);

-- Club Members
INSERT INTO club_members (club_id, student_id)
VALUES
(1, 1), -- Alice joins Science Club
(2, 2), -- Bob joins Art Club
(3, 4); -- David joins Sports Club

-- Events
INSERT INTO events (club_id, title, description, event_date, location, image_url)
VALUES
(1, 'Physics Workshop', 'Learn about physics experiments', '2026-02-10', 'Lab 101', 'images/physics.jpg'),
(2, 'Painting Contest', 'Show off your painting skills', '2026-02-15', 'Art Room', 'images/painting.jpg'),
(3, 'Football Match', 'Friendly football game', '2026-02-20', 'Sports Field', 'images/football.jpg');

-- Event Participants
INSERT INTO event_participants (event_id, student_id, participated)
VALUES
(1, 1, TRUE), -- Alice attended Physics Workshop
(2, 2, FALSE), -- Bob registered for Painting Contest
(3, 4, TRUE); -- David attended Football Match

-- Reviews
INSERT INTO reviews (event_id, student_id, rating, comment)
VALUES
(1, 1, 5, 'Amazing workshop! Learned a lot.'),
(3, 4, 4, 'Fun football match, could be longer.');

-- Articles
INSERT INTO articles (club_id, event_id, title, content, image_url)
VALUES
(1, 1, 'Physics Workshop Recap', 'We had an amazing physics workshop last week...', 'images/physics_article.jpg'),
(2, NULL, 'Art Club Monthly Update', 'This month we focused on watercolor techniques...', 'images/art_article.jpg'),
(3, 3, 'Football Match Highlights', 'Highlights from our friendly football match...', 'images/football_article.jpg');
