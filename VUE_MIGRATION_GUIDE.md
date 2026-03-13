# Vue.js Migration Guide

## Why Vue.js Instead of PHP?

**Benefits of the Modern Vue.js Approach:**
- **Better UX**: Reactive, SPA-like experience
- **Modern Stack**: Component-based architecture
- **Performance**: Faster loading and interactions
- **Maintainability**: Cleaner, organized code
- **Scalability**: Easier to extend features

## Migration Status

### ✅ Completed:
- **Frontend**: Modern Vue.js/Nuxt.js projects page (`/frontend/pages/projects.vue`)
- **Backend**: RESTful API endpoints (`/backend/api/projects.js`)
- **Navigation**: Updated Header component with projects link

### 🚀 New Features:
- **Enhanced UI**: Card-based layout with status badges
- **Full CRUD**: Create, Read, Update, Delete operations
- **Better UX**: Loading states, empty states, modals
- **Responsive**: Mobile-friendly design
- **Real-time**: Instant updates without page reloads

## How to Use

### 1. Start Backend API:
```bash
cd backend
npm install
npm run dev
```

### 2. Start Frontend:
```bash
cd frontend
npm install
npm run dev
```

### 3. Access:
- Frontend: http://localhost:3002
- Backend API: http://localhost:3001/api
- Projects Page: http://localhost:3002/projects

## API Endpoints

- `GET /api/projects` - Get all projects
- `GET /api/projects?status=ongoing` - Filter by status
- `POST /api/projects` - Create project
- `PUT /api/projects/:id` - Update project
- `DELETE /api/projects/:id` - Delete project

## Legacy PHP Files (Can be removed):
- `projects.php`
- `view_projects.php`
- `get_projects.php`
- `process_upload_project.php`
- `update_project.php`
- `delete_project.php`

## Next Steps
1. Test the new Vue.js implementation
2. Migrate other sections (beneficiaries, partners, etc.)
3. Remove legacy PHP files
4. Deploy the modern stack
