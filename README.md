<div align="center">
<img src="https://github.com/memorezasabana/Explore_Github/blob/main/logo-Instalyze.png" alt="Deskripsi Gambar" width="250px">
</div>

<div align="center">
  <h1>Instalyze: Instagram Bio Analyzer (SEO Tools)</h1>
</div>
Instalyze is a website designed to help users analyze their Instagram profiles, hashtags, and caption headlines, as well as those of others. This website provides in-depth insights aimed at improving account performance, hashtag effectiveness, and content appeal, ultimately increasing user interaction and engagement.

## 🚀 **Key Features**
- [x] ✨ **In-depth Instagram Profile Analysis**
> Provides complete statistics such as account score, engagement score, average activity, posting frequency, and sentiment analysis to understand profile performance.
- [x] ⚡ **Hashtag Usage Optimization**
> Helps analyze relevant and effective hashtags to expand reach and increase engagement on each post.
- [x] 🔒 **Maximizing Caption Headlines**
> Analyzes caption headlines to help create engaging content that matches audience preferences, increasing the impact and interaction of every post.

## 🛠️ **Prerequisites**
Make sure you have the following installed before running the project:
- [x] PHP (8.1 or higher)
- [x] Composer
- [x] MySQL
- [x] Git

## 🔧 **Installation**
1. **Navigate to your desired folder**
   <br>Right-click inside the folder where you want to clone the project and select "Open Git Bash here" (or open the terminal in that folder).
2. **Clone the repository**
   <br>Run the following command in the terminal to clone the repository:
   ```
   git clone https://github.com/AgileRE-2024/Instalyze.git
   ```
3. **Navigate into the project folder**
   <br> After cloning, change into the project directory with the following command:
   ```
   cd Instalyze
   ```
4. **Install dependencies**
   <br>Run the following command to install the necessary PHP dependencies:
   ```
   composer install
   ```
5. **Create a database in phpMyAdmin**
   - Start Apache and MySQL
   - Open phpMyAdmin in your browser (usually http://localhost/phpmyadmin).
   - Click on the Databases tab.
   - In the Create database section, enter Instalyze as the name for your database and click Create.
6. **Copy the .env file and configure it**
   <br>Copy the example .env file and configure it with your database details:
   ```
   cp .env.example .env
   ```
   - Open the .env file and update the database configuration with the details of the database you just created in phpMyAdmin:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=Instalyze
     DB_USERNAME=root
     DB_PASSWORD=
     ```
7. **Generate the application key**
     <br>Run the following command to generate the Laravel application key:
     ```
     php artisan key:generate
     ```
8. **Migrate the database**
   <br>Run the following command to migrate the database:
   ```
   php artisan migrate
   ```
9. **Run the local server**
   <br>Start the Laravel development server:
   ```
   php artisan serve
   ```
   Access the application at http://127.0.0.1:8000.

## 🖥️ **Usage**
- [x] **Input Instagram Username**
>Users can enter an Instagram username to analyze the profile.
- [x] **View Username Analysis**
>The system will display detailed information about the profile, including bio, number of followers, number of posts, posting times, frequently used hashtags, and posts with the most likes and comments.
- [x] **Input Headline**
>Users can enter a headline they want to analyze.
- [x] **View Headline Analysis**
>The system will provide an analysis of the headline, including word and character count, as well as recommendations for similar headlines.
- [x] **Input Hashtag**
>Users can enter a hashtag they want to analyze.
- [x] **View Hashtag Analysis**
>The system will show an analysis of the hashtag and display popular posts related to it.
- [x] **Access Search History**
>Users can view their search history for profiles, hashtags, or headlines.
<br>Note: To access the history, you need to log in. However, logging in is optional, and you can still use other features without logging in.

## 🚀 **Advantages**

- [x] **Real-time Data Access**  
   The system allows users to access data directly from Instagram, providing up-to-date information about profiles, hashtags, and captions.
- [x] **Recommendations**  
   The system provides useful recommendations based on the analysis, helping users optimize their Instagram content, hashtags, and captions for better engagement.
- [x] **User-friendly Interface**  
   Instalyze features an easy-to-use interface, making it accessible even for users with no technical background. You can quickly navigate and access insights with just a few clicks.
- [x] **Comprehensive Analysis**  
   The tool provides in-depth analysis for Instagram profiles, hashtags, and captions, giving users valuable insights into their performance and areas for improvement.
- [x] **Optimized for Engagement**  
   By analyzing content and hashtags, the system helps users identify the most effective ways to increase reach, engagement, and overall social media performance.


## 🤝 **Creators**
This project was developed by **Group 1 of Software Development (Practicum) I3, Bachelor's Degree in Information Systems, Airlangga University**, under the guidance of the following mentors:  
1. Badrus Zaman, S.Kom., M.Cs.
2. Dr. Indra Kharisma Raharjana, S.Kom., M.T.

👥 Team Members
  
| **Role**          | **Name**                        | **NIM**       |
|-------------------|---------------------------------|---------------|
| **Project Manager** | Memoreza Sabana               | 187221007     |
| **Member**         | Rizka Alya Damayanti           | 187221002     |
| **Member**         | Marvel Jeremia Putra Tjahyadi  | 187221014     |
| **Member**         | Nadine Abigail                 | 187221032     |
| **Member**         | Nabigha Muhana Zayyan          | 187221035     |
