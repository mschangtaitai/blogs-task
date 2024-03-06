# Blog

## Goal
The goal is to create a blogging application that interacts with various systems and functionalities using Laravel and connects the developed API to Vue.js.

## Laravel
- Implement CRUD operations for the entities.
- Implement authentication using Sanctum.
- Utilize Docker with Sail:
    - Set up MySQL service with a volume in the Docker Compose file.
    - Set up Redis service with a volume in the Docker Compose file.
- Allow only users who created blogs to update them.
- Research Dependency Injection in Laravel.
- Create services for actions and inject them with DI, for example:
    - BlogService
        - create: Creates a blog and returns the eloquent model created.
- Display blogs only when the `available_at` value is not present or is earlier than the current date.
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
    - Login
    - Feed (Paginated)
    - Blog detail (Show comments of the blog and allow expanding on comments)
    - User detail with its blogs (Paginated by infinite scrolling)
- Use Pinia for state management:
    - Store the blogs from the feed in Pinia.
    - Update a blog from its detail and also update it from the feeds.
    - Utilize persisted state for the feed.
- Use logic with compositions when useful.
- Implement Vee-Validate library for value validations.
- Develop all components using the setup script tag.
