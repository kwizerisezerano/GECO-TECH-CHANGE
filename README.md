# GECO RWANDA - Modern Web Application

A modern web application for GECO RWANDA (Global Epilepsy Connection), built with Nuxt.js frontend and Node.js/Express backend.

## Project Structure

```
gecorwanda/
├── frontend/          # Nuxt.js frontend application
│   ├── pages/        # Vue pages
│   ├── components/   # Vue components
│   ├── assets/       # Static assets
│   ├── stores/       # Pinia stores
│   └── composables/  # Vue composables
├── backend/          # Express.js backend API
│   ├── server.js     # Main server file
│   ├── .env          # Environment variables
│   └── package.json  # Backend dependencies
└── README.md         # This file
```

## Technology Stack

### Frontend
- **Nuxt.js 3** - Vue.js framework for SSR/SSG
- **Vue 3** - Progressive JavaScript framework
- **Tailwind CSS** - Utility-first CSS framework
- **Pinia** - State management
- **Axios** - HTTP client

### Backend
- **Node.js** - JavaScript runtime
- **Express.js** - Web framework
- **MySQL2** - MySQL database driver
- **CORS** - Cross-origin resource sharing
- **dotenv** - Environment variable management

## Features

- ✅ Responsive design
- ✅ Dynamic statistics dashboard
- ✅ Portfolio/gallery section
- ✅ Donation system
- ✅ Partner and beneficiary management
- ✅ Document management
- ✅ Modern UI/UX
- ✅ SEO optimized
- ✅ Mobile-friendly navigation

## Getting Started

### Prerequisites
- Node.js 18+ installed
- MySQL database running
- Existing PHP application database

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd gecorwanda
   ```

2. **Install backend dependencies**
   ```bash
   cd backend
   npm install
   ```

3. **Configure environment variables**
   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

4. **Install frontend dependencies**
   ```bash
   cd ../frontend
   npm install
   ```

### Running the Application

1. **Start the backend server**
   ```bash
   cd backend
   npm run dev
   ```
   The API will be available at `http://localhost:3001`

2. **Start the frontend development server**
   ```bash
   cd frontend
   npm run dev
   ```
   The application will be available at `http://localhost:3000`

## API Endpoints

### Statistics
- `GET /api/stats` - Get application statistics (beneficiaries, projects, partners, donations)

### Projects
- `GET /api/projects` - Get all projects
- `POST /api/projects` - Create new project
- `PUT /api/projects/:id` - Update project
- `DELETE /api/projects/:id` - Delete project

### Beneficiaries
- `GET /api/beneficiaries` - Get all beneficiaries
- `POST /api/beneficiaries` - Add new beneficiary
- `PUT /api/beneficiaries/:id` - Update beneficiary
- `DELETE /api/beneficiaries/:id` - Delete beneficiary

### Partners
- `GET /api/partners` - Get all partners
- `POST /api/partners` - Add new partner
- `PUT /api/partners/:id` - Update partner
- `DELETE /api/partners/:id` - Delete partner

### Donations
- `GET /api/donations` - Get all donations
- `POST /api/donation` - Process new donation

## Database Schema

The application uses the existing database schema from the PHP application:

- `beneficiaries` - People benefiting from GECO's services
- `projects` - Projects and initiatives
- `partners` - Partner organizations
- `donation` - Donation records
- `members` - Team members

## Deployment

### Frontend (Nuxt.js)
```bash
cd frontend
npm run build
npm run preview
```

### Backend (Express.js)
```bash
cd backend
npm start
```

## Environment Variables

### Backend (.env)
```
PORT=3001
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=your_password
DB_NAME=gecorwanda
```

### Frontend
The frontend uses the `API_BASE` environment variable configured in `nuxt.config.ts`:
```typescript
runtimeConfig: {
  public: {
    apiBase: process.env.API_BASE || 'http://localhost:3001/api'
  }
}
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## Migration from PHP

This application successfully migrates from the original PHP application with:

- **Preserved Design**: Maintains the original visual design and user experience
- **Enhanced Performance**: Modern JavaScript framework for better performance
- **Improved SEO**: Server-side rendering for better search engine optimization
- **Mobile Responsiveness**: Enhanced mobile experience
- **Modern Development**: Component-based architecture for maintainability
- **API-First**: RESTful API for potential mobile app development

## Support

For support and questions:
- Email: info@gecorwanda.org
- Phone: +250 788 123 456

## License

© 2024 GECO RWANDA. All Rights Reserved.
