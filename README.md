# Detective Green
A web-app that encourages first-year high school students to take real action for nature!

:mag: Check out the live version: https://team2.hr-cmgt-tle2-laravel.nl

<details>
    <summary>Table of Contents</summary>
    <ol>
        <li><a href="#about-this-project">About this project</a></li>
        <li><a href="#functionality">Functionality</a></li>
        <li>
            <a href="#getting-started">Getting started</a>
            <ol>
                <li><a href="#requirements">Requirements</a></li>
                <li><a href="#installation">Installation</a></li>
            </ol>
        </li>
    </ol>
</details>



## About this project
Detective Green is the web-app to get first-year high school students excited about nature again! By collaborating with your class on various quests, they'll truly feel like their actions are making an impact!

This project was commissioned by and created in collaboration with Natuurmonumenten and iO. Natuurmonumenten struggles to reach young people between the ages of 12 and 21. Detective Green ensures that Natuurmonumenten can raise awareness of nature by encouraging green behavior and the making an impact on nature through a curriculum for high schools.



## Functionality
Detective Green is packed with cool features to easily integrate the web-app into your current curriculum!
### Quests
- Complete a variety of Quests, together with your class or at home!
- Discover unique types of Quests, from impact-making to multiple-choice questions!
- Receive rewards for completing Quests!
### Rewards
- Get points for completing Quests!
- Improve your own digital Nature Reserve by cleaning it and adding more plants and biodiversity!
### Leaderboard
- Climb the global leaderboard by collecting more points with your class!
- Become the best Green Detective!
### Management for Teachers
- Easily create new classes!
- Generate class-codes for your students to join your class!
- Manage members of your class by assigning roles like Student, Teacher or Guest!



## Getting started
If you want to run the project locally, use the following steps.
### Requirements
- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite
- (If on Windows) Laravel Herd
### Installation
1. Clone the repository
```sh
git clone https://github.com/Konijnebeer/TLE-2.git detective-green
cd detective-green
```
2. Setup dependencies, environment, database and front-end assets
```sh
composer run setup
```
3. Setup local test server
```sh
npm run dev
```
- If you're using Windows:
    - Make sure the project is in the Laravel Herd sites directory and SSL is enabled for it
    - View the web-app by going to https://detective-green.test
- If you're not on Windows:
    ```sh
    php artisan serve
    ```
    View the web-app by going to http://localhost:8000
