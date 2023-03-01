# obox_livedash_task

## Running the project

1. Clone the repo
2. If using Node or NPM: 
    - Run `npm run start:server`
3. If using PHP:
    - Run `php -S localhost:8000 -t ./src`
    - If using homebrew ensure httpd is running and use above command or use `brew services start httpd && php -S localhost:8000 -t ./src`
4. Open `http://localhost:8000` 

## Objective: Build a Live Users Dashboard
A JavaScript application that shows current online users. 

### Entrance Page
A form with a name & email fields.

### Main Page
A page with at least the following components:
1. Welcome message - including current username
2. Current online users list
    - Name
    - Entrance time
    - Last update time
    - User IP
3. The online list should be refreshed every 3s.
4. Click on a user - fetch data from server and show it on a simple popup with the following
user details:
    - Name
    - Email
    - User-Agent
    - Entrance time
    - Visits count
5. On closing the tab/browser, the user should be marked as offline. 

### Languages

- JS ES6+ - A module, vanilla JS, no babel/transpiler
- CSS3+ - SCSS files + compiled, Without frameworks/libraries PHP8+ - OOP, for data fetch/update only
- DB - use text files
- Unit test - use your favorite

The final project should be sent as a Git repository with all commits + a live demo.

## How I'm going to approach this task
1. Setup required files and folder structure. :check:
2. Add unit testing tool for PHP. :check:
3. Quickly build simple UIs for pages using HTML/SCSS - using some simple flexbox layouts. Nothing fancy. :check:
4. Build a simple user manager class to update "db" text files with user online status and data. :check:
5. Setup up the name and email form to send a request to the server to add a new user or update an existing user with online status. :check:
6. Setup up a simple JS module to handle the live updates of the users online list and ping server every 3s for changes of online status. :wip:
7. Update unit tests to cover session manager functionality.
8. Refactor and clean up.

## Thoughts
1. Is Unit testing that important on the client side? In my opinion not really, validation is more imporant in this case.
2. For simplicity sake will use SASS from the command line to compile scss files to css.
3. Would be nice to add task runner to do all the copy, pasting, building and moving of files to the correct locations. But is not necessary so will add if time allows.
4. Will be doing my best to restrict myself to a 4 hour time limit. However considering how rusty I am in PHP I feel I may need a little extra time.
5. Will store online status in locale storage and update to offline on browser close, in this event we can update the "db" text files. 
6. Would be nice to use an observer pattern to update the online list as this will negate the necessity to ping "db" every 3s. But will leave this for now as it could be a little overkill.
7. Haven't worked with text files as "db" in a long time. 

## Concerns
1. I'm very rusty with PHP and feel that I may not write the most optimised code.
2. I've never worked with PHP unit testing before. Only JS unit testing. This may take longer than expected. (it did)...
3. Will add more concerns if I think of any that are pressing. 


## Notes 
1. Fiddled with the SCSS and HTML for too long
2. Was interrupted as family is coming to stay for a few days and needed to help them unpack the car - 15 min delay from previous break.
3. Need to take 10 - 15 min to evaulate if on the right track still.
4. Right taken much longer than expected however I have taken a couple breaks during this process and pause for dinner.
5. This has taken about 7 hours - I'm clearly rusty with PHP as I feel this should have gone much quicker.
6. In hindesight I believe that I should have done the JS first and then the PHP, sticking closer to the initial plan. Going back and forth has wasted significant time. 
7. After quick evaluation of tasks required, I realise I shouldn't have built an API type setup and instead used a more simple php style set of pages - this would have been much quicker.
8. So I'm driven to complete this and feel that although this has taken long, I would only do a deservice to myself to not finish.
9. I think I made my life hard by trying to use a single txt file to store all users, for some reason I can't quite get the update user logic to work smoothly, may be best to just create a file for each user and then just update that file - like one file is one row in a DB.
10. So it's taken a lot to get to this point in all honesty, I'm not happy with the code, this could be infinitely better and simpler, silly issues persist, like CSS layouts adjusting when classes are removed, but base class is still there.
11. To be prefectly honest I don't think this has been my best, I've put much effort but I believe this is not the best I could do. 
12. I'm submitting in this state and hoping that feedback will assist in providing me some guidance on how to improve.
13. Total time to this point around 10.5 hours... >:(
14. Things I didn't get to, validation of form fields, checking IP, visits and last login vs current login, unit tests.
15. Did some clean up and refactoring as I went, but not satisfied, there are many areas where this could simplified, if only by using shorthand alternatives. 
16. Got lost in the logic a couple times and bounced back and forth too much, should have tried to work from one direction through to the end.
17. Seems I have much to brush up on. 
18. Text file manipulation in PHP is not my strong point...
19. PHP has some nice array methods I didn't know existed, not that used them much in the end. 
