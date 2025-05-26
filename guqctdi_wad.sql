-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: nov. 05, 2024 la 11:45 PM
-- Versiune server: 10.4.27-MariaDB
-- Versiune PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `guqctdi_wad`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `modules` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `modules`, `hours`, `image_path`) VALUES
(1, 'Ultimate React Native Course', 'Learn how to build professional mobile apps using Expo and React Native. This course will take you from beginner to advanced, providing hands-on examples and real-world projects.', 6, 6, 'https://andreyka26.com/assets/2024-05-31-react-native-set-up-for-beginners/logo-wide.png'),
(2, 'Create a Full Stack Expo App ', 'Learn how to create a Full Stack Expo app with Supabase, Clerk auth and many more features!', 6, 5, 'https://i.ytimg.com/vi/Zs-W12TpAeM/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCl2pz0XIWxmUvCwo555ZGpMLPcGA');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `lesson_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `content`, `lesson_order`) VALUES
(1, 1, 'Introduction to React Native', '<h2>Welcome to React Native</h2>\r\n<p>React Native is an open-source framework created by Facebook for building mobile applications using JavaScript and React. It allows developers to create applications for both iOS and Android using a single codebase. In this lesson, you’ll get an overview of what React Native is, its benefits, and its core principles.</p>\r\n\r\n<h3>Topics Covered</h3>\r\n<ul>\r\n    <li><strong>Introduction to Cross-Platform Development:</strong> Learn why React Native is popular for creating cross-platform applications.</li>\r\n    <li><strong>Benefits of React Native:</strong> Explore the advantages of using React Native, such as faster development time and code reusability.</li>\r\n    <li><strong>Setting Up the Development Environment:</strong> Step-by-step guide on installing Node.js, the React Native CLI, and configuring Android and iOS simulators.</li>\r\n</ul>\r\n\r\n<h3>Code and Commands</h3>\r\n<pre><code>npx react-native init MyFirstApp\r\ncd MyFirstApp\r\nnpx react-native run-android # for Android emulator\r\nnpx react-native run-ios # for iOS simulator (only on macOS)\r\n</code></pre>\r\n\r\n<h3>Key Takeaways</h3>\r\n<p>By the end of this lesson, you will have an understanding of what React Native is, and your development environment will be set up to start building apps.</p>\r\n', 0),
(2, 1, 'Setting Up Your First Project', '<h2>Building and Exploring Your First Project</h2>\r\n<p>In this lesson, you’ll learn how to initialize a React Native project and explore its structure. Understanding the core files and folders will help you navigate and organize your code efficiently.</p>\r\n\r\n<h3>Topics Covered</h3>\r\n<ul>\r\n    <li><strong>Initializing a New Project:</strong> How to set up a new React Native project with the CLI.</li>\r\n    <li><strong>Folder Structure:</strong> Learn about the key folders and files such as <code>App.js</code>, <code>node_modules</code>, <code>android</code>, and <code>ios</code>.</li>\r\n    <li><strong>Running the App:</strong> Guide on running the app on emulators and physical devices.</li>\r\n</ul>\r\n\r\n<h3>Code and Commands</h3>\r\n<pre><code>npx react-native init MyApp\r\ncd MyApp\r\nnpx react-native start\r\nnpx react-native run-android\r\n</code></pre>\r\n\r\n<h3>Practice Exercise</h3>\r\n<p>Open <code>App.js</code> and replace the content with a custom message. Test your app on both Android and iOS simulators.</p>\r\n\r\n<h3>Key Takeaways</h3>\r\n<p>By the end of this lesson, you will be able to initialize a React Native project and navigate the core files.</p>\r\n', 0),
(3, 1, 'Core Components and Styling Techniques', '<h2>Working with Components and Styling</h2>\r\n<p>React Native uses components to build interfaces. In this lesson, you’ll learn about the essential components, how to customize them with styles, and how to use Flexbox to create responsive layouts.</p>\r\n\r\n<h3>Topics Covered</h3>\r\n<ul>\r\n    <li><strong>Core Components:</strong> Introduction to components like <code>View</code>, <code>Text</code>, <code>Image</code>, and <code>Button</code>.</li>\r\n    <li><strong>Creating Custom Styles:</strong> Use the <code>StyleSheet</code> API to apply CSS-like styling.</li>\r\n    <li><strong>Using Flexbox:</strong> Responsive design with Flexbox properties such as <code>justifyContent</code>, <code>alignItems</code>, and <code>flexDirection</code>.</li>\r\n</ul>\r\n\r\n<h3>Code and Examples</h3>\r\n<pre><code>import React from \'react\';\r\nimport { View, Text, StyleSheet, Image } from \'react-native\';\r\n\r\nconst Profile = () => (\r\n    &lt;View style={styles.container}>\r\n        &lt;Text style={styles.title}>Profile&lt;/Text>\r\n        &lt;Image source={{ uri: \'https://example.com/profile.png\' }} style={styles.image} />\r\n    &lt;/View>\r\n);\r\n\r\nconst styles = StyleSheet.create({\r\n    container: { flex: 1, alignItems: \'center\', padding: 20 },\r\n    title: { fontSize: 24, fontWeight: \'bold\' },\r\n    image: { width: 100, height: 100, borderRadius: 50 },\r\n});\r\n</code></pre>\r\n\r\n<h3>Exercise</h3>\r\n<p>Create a custom profile card with name, avatar, and a short description. Experiment with Flexbox properties to align the items.</p>\r\n', 0),
(4, 1, 'State, Props, and Data Flow', '<h2>Managing Data with State and Props</h2>\r\n<p>State and props are the foundation of data handling in React Native. In this lesson, you’ll learn to manage dynamic data in your app.</p>\r\n\r\n<h3>Topics Covered</h3>\r\n<ul>\r\n    <li><strong>Props:</strong> Passing data to child components and making them reusable.</li>\r\n    <li><strong>State:</strong> Using the <code>useState</code> hook to manage component state.</li>\r\n    <li><strong>Data Flow:</strong> How data flows from parent to child components.</li>\r\n</ul>\r\n\r\n<h3>Code Example</h3>\r\n<pre><code>import React, { useState } from \'react\';\r\nimport { View, Text, Button } from \'react-native\';\r\n\r\nconst Counter = () => {\r\n    const [count, setCount] = useState(0);\r\n    return (\r\n        &lt;View>\r\n            &lt;Text>Count: {count}&lt;/Text>\r\n            &lt;Button title=\"Increase\" onPress={() => setCount(count + 1)} />\r\n        &lt;/View>\r\n    );\r\n};\r\n</code></pre>\r\n\r\n<h3>Exercise</h3>\r\n<p>Create a counter component that displays a count. Add buttons to increase and decrease the count. Use props to pass the initial count to the component.</p>\r\n', 0),
(5, 1, 'Navigation in React Native', '<h2>Implementing Navigation with React Navigation</h2>\r\n<p>Navigation is crucial for multi-screen applications. In this lesson, you’ll use React Navigation to create a stack of screens.</p>\r\n\r\n<h3>Topics Covered</h3>\r\n<ul>\r\n    <li><strong>Installing React Navigation:</strong> Step-by-step installation of required packages.</li>\r\n    <li><strong>Stack Navigation:</strong> Creating and configuring a stack navigator.</li>\r\n    <li><strong>Passing Data Between Screens:</strong> How to pass parameters between screens.</li>\r\n</ul>\r\n\r\n<h3>Code Example</h3>\r\n<pre><code>import { NavigationContainer } from \'@react-navigation/native\';\r\nimport { createStackNavigator } from \'@react-navigation/stack\';\r\n\r\nconst Stack = createStackNavigator();\r\n\r\nconst App = () => (\r\n    &lt;NavigationContainer>\r\n        &lt;Stack.Navigator initialRouteName=\"Home\">\r\n            &lt;Stack.Screen name=\"Home\" component={HomeScreen} />\r\n            &lt;Stack.Screen name=\"Details\" component={DetailsScreen} />\r\n        &lt;/Stack.Navigator>\r\n    &lt;/NavigationContainer>\r\n);\r\n</code></pre>\r\n\r\n<h3>Exercise</h3>\r\n<p>Create a simple two-screen navigation setup. Pass data from the Home screen to the Details screen and display it.</p>\r\n', 0),
(6, 1, 'Networking and API Integration', '<h2>Fetching Data from APIs in React Native</h2>\r\n<p>APIs allow apps to communicate with servers and retrieve data. In this lesson, you’ll learn to fetch and display data from an API.</p>\r\n\r\n<h3>Topics Covered</h3>\r\n<ul>\r\n    <li><strong>Fetch API:</strong> Using <code>fetch</code> to retrieve data from APIs.</li>\r\n    <li><strong>Axios:</strong> An alternative for making HTTP requests.</li>\r\n    <li><strong>Displaying Data:</strong> Render the fetched data within components.</li>\r\n</ul>\r\n\r\n<h3>Code Example</h3>\r\n<pre><code>import React, { useEffect, useState } from \'react\';\r\nimport { View, Text } from \'react-native\';\r\nimport axios from \'axios\';\r\n\r\nconst DataFetcher = () => {\r\n    const [data, setData] = useState(null);\r\n\r\n    useEffect(() => {\r\n        axios.get(\'https://api.example.com/data\')\r\n            .then(response => setData(response.data))\r\n            .catch(error => console.error(error));\r\n    }, []);\r\n\r\n    return (\r\n        &lt;View>\r\n            &lt;Text>{JSON.stringify(data)}&lt;/Text>\r\n        &lt;/View>\r\n    );\r\n};\r\n</code></pre>\r\n\r\n<h3>Exercise</h3>\r\n<p>Create a component that fetches and displays data from a public API. Display key information and handle loading and error states.</p>\r\n', 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `correct_option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `quizzes`
--

INSERT INTO `quizzes` (`id`, `lesson_id`, `question`, `options`, `correct_option`) VALUES
(13, 1, 'What is React Native?', '[\"A web development library\", \"A mobile app framework\", \"A server-side framework\", \"A database tool\"]', 'A mobile app framework'),
(14, 1, 'What language is primarily used to code React Native applications?', '[\"Python\", \"JavaScript\", \"Java\", \"C++\"]', 'JavaScript'),
(15, 2, 'Which file is the main entry point of a React Native app?', '[\"index.js\", \"App.js\", \"Main.js\", \"home.js\"]', 'App.js'),
(16, 2, 'Where are project dependencies stored in a React Native app?', '[\"node_modules\", \"app_modules\", \"dependencies\", \"libs\"]', 'node_modules'),
(17, 3, 'Which component is used to display text in React Native?', '[\"Text\", \"Paragraph\", \"Label\", \"Span\"]', 'Text'),
(18, 3, 'Which API is used for styling in React Native?', '[\"StyleSheet\", \"CSS\", \"InlineStyle\", \"StyleManager\"]', 'StyleSheet'),
(19, 4, 'What hook is commonly used to handle state in React Native?', '[\"useState\", \"useProps\", \"useEffect\", \"useContext\"]', 'useState'),
(20, 4, 'What is the purpose of props in React Native?', '[\"To manage state\", \"To pass data to children components\", \"To add styles\", \"To make HTTP requests\"]', 'To pass data to children components'),
(21, 5, 'Which library is commonly used for navigation in React Native?', '[\"React Navigation\", \"React Router\", \"Redux\", \"Navigator\"]', 'React Navigation'),
(22, 5, 'What does stack navigation allow you to do?', '[\"Scroll vertically\", \"Go back and forth between screens\", \"Create buttons\", \"Display images\"]', 'Go back and forth between screens'),
(23, 6, 'Which method is commonly used to fetch data in React Native?', '[\"retrieve()\", \"fetch()\", \"connect()\", \"request()\"]', 'fetch()'),
(24, 6, 'What format is typically used for data transfer in API communication?', '[\"XML\", \"JSON\", \"YAML\", \"CSV\"]', 'JSON');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'mosakay', 'liviu05f@gmail.com', '$2y$10$tcPHRAefAcEr0.89cOSzZuKFLyWHd8kerUfGbUXApzEZXxaW16fpe', 'admin', '2024-10-23 08:10:10'),
(2, 'test', 'test@test.ro', '$2y$10$.wFsvqPX5k7ehuP1iIPcMecnXJivtyXs34xqH3S5HfBE2RKpSMjoy', 'user', '2024-10-23 10:25:47'),
(4, 'asdfg', 'asdf@asfg.com', '$2y$10$dra7Qj4.yWvxltEYcwmPReqeFCYykXCHGCZBnVRvSwoRZO3yn5Gsa', 'user', '2024-11-05 18:28:29'),

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `user_progress`
--

CREATE TABLE `user_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `progress_percentage` decimal(5,2) DEFAULT 0.00,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `user_progress`
--

INSERT INTO `user_progress` (`id`, `user_id`, `course_id`, `lesson_id`, `completed`, `progress_percentage`, `updated_at`) VALUES
(15, 1, 1, 1, 1, '0.00', '2024-11-05 19:29:06'),
(16, 1, 1, 2, 1, '0.00', '2024-11-05 19:29:14'),
(17, 1, 1, 3, 1, '0.00', '2024-11-05 19:48:31'),
(18, 1, 1, 4, 1, '0.00', '2024-11-05 19:50:01'),
(19, 1, 1, 5, 1, '0.00', '2024-11-05 19:50:07'),
(20, 1, 1, 6, 1, '0.00', '2024-11-05 19:50:14'),
(21, 5, 1, 1, 1, '0.00', '2024-11-05 22:36:04'),
(22, 5, 1, 2, 1, '0.00', '2024-11-05 22:36:13');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexuri pentru tabele `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexuri pentru tabele `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_progress` (`user_id`,`course_id`,`lesson_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pentru tabele `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pentru tabele `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `user_progress`
--
ALTER TABLE `user_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constrângeri pentru tabele `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

--
-- Constrângeri pentru tabele `user_progress`
--
ALTER TABLE `user_progress`
  ADD CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_progress_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_progress_ibfk_3` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
