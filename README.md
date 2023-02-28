# obox_livedash_task

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
1. Setup required files and folder structure.
2. Add unit testing tool for PHP.
3. Quickly build simple UIs for pages using HTML/SCSS - using some simple flexbox layouts. Nothing fancy.
4. Build a simple session manager class to update "db" text files with user online status and data.
5. Setup up the name and email form to send a request to the server to add a new user or update an existing user with online status.
6. Setup up a simple JS module to handle the live updates of the users online list and ping server every 3s for changes of online status.
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
2. I've never worked with PHP unit testing before. Only JS unit testing. This may take longer than expected. 
3. Will add more concerns if I think of any that are pressing. 