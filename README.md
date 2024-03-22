# Blog

## Goal
The goal is to create a blogging application that interacts with various systems and functionalities using Laravel and connects the developed API to Vue.js.

## Laravel
- Implement CRUD operations for the entities. :heavy_check_mark:
- Implement authentication using Sanctum. :heavy_check_mark:
- Utilize Docker with Sail: :heavy_check_mark:
    - Set up MySQL service with a volume in the Docker Compose file. :heavy_check_mark:
    - Set up Redis service with a volume in the Docker Compose file. :heavy_check_mark:
- Allow only users who created blogs to update them. :heavy_check_mark:
- Research Dependency Injection in Laravel. :heavy_check_mark:
- Create services for actions and inject them with DI, for example: :heavy_check_mark:
    - BlogService
        - create: Creates a blog and returns the eloquent model created. :heavy_check_mark:
- Display blogs only when the `available_at` value is not present or is earlier than the current date. :heavy_check_mark:
- Implement a Scheduler:
    - Create a job that runs hourly to check if there are blogs becoming available within the next hour. Send an email and Discord message to the user with the log driver if no free driver is available.

## Database
- **Blogs**
    - Id
    - user_id
    - title
    - content (varchar)
    - hide_comments (boolean)
    - available_at (nullable Timestamp)
- **Comments** (Polymorphic relationship to a comment or a blog)
    - Id
    - user_id
    - commentable_type
    - commentable_id
    - comment (varchar)
- **User**
    - Id
    - first_name
    - last_name
    - password (hashed)
    - username

## Vue
- **Vue3**
- Utilize Vue Router with the following paths: 
    - Login :heavy_check_mark:
    - Feed (Paginated  by infinite scrolling) :heavy_check_mark:
    - Blog detail (Show comments of the blog and allow expanding on comments) :heavy_check_mark:
    - User detail with its blogs (Paginated) :heavy_check_mark:
- Use Pinia for state management: :heavy_check_mark:
    - Store the blogs from the feed in Pinia. :heavy_check_mark:
    - Update a blog from its detail and also update it from the feeds. :heavy_check_mark:
    - Utilize persisted state for the feed. 
- Use logic with compositions when useful. :heavy_check_mark:
- Implement Vee-Validate library for value validations. :heavy_check_mark:
- Develop all components using the setup script tag. :heavy_check_mark:
