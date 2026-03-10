# GECO RWANDA Contact Form Configuration

## Overview
The GECO RWANDA contact form is configured to send emails to `globalepelepticc@gmail.com` using the app password `qmoa glal asot ogqx`.

## Frontend (Vue/Nuxt)
- **Location**: `frontend/pages/index.vue`
- **Form Handler**: `submitForm()` function in the script section
- **API Endpoint**: `/api/contact` (POST request)
- **Features**:
  - Form validation
  - Loading states
  - Success/error messages
  - Responsive design

## Backend API (Node.js/Nuxt)
- **Location**: `frontend/server/api/contact.post.js`
- **Email Service**: Nodemailer with Gmail SMTP
- **Configuration**:
  ```javascript
  service: 'gmail',
  auth: {
    user: 'globalepelepticc@gmail.com',
    pass: 'qmoa glal asot ogqx' // App password
  }
  ```

## PHP Backend (Alternative)
- **Primary**: `forms/contact.php` (uses PHP Email Form library)
- **Backup**: `forms/contact-simple.php` (uses PHP mail function)
- **Both configured to send to**: `globalepelepticc@gmail.com`

## Email Template
The contact form sends beautifully formatted HTML emails with:
- GECO RWANDA branding
- Contact information (name, email, phone, subject, message)
- Timestamp
- Professional styling

## Testing
To test the contact form:
1. Navigate to `http://localhost:3001/`
2. Scroll to the Contact section
3. Fill out the form fields
4. Click "Send Message"
5. Check `globalepelepticc@gmail.com` for the email

## Security Notes
- App password is used instead of regular Gmail password
- Form validation on both frontend and backend
- Email sanitization in PHP version
- CORS handled by Nuxt automatically

## Dependencies
- Frontend: Vue 3, Nuxt 3, TailwindCSS
- Backend: Nodemailer (Node.js), PHP Email Form library (optional)
- Email Service: Gmail SMTP

## Troubleshooting
If emails are not sending:
1. Check Gmail app password is correct
2. Verify Gmail allows less secure apps or use app password
3. Check server logs for error messages
4. Test with the PHP backup form at `/forms/contact-simple.php`
