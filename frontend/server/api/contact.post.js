import nodemailer from 'nodemailer'

export default defineEventHandler(async (event) => {
  try {
    const body = await readBody(event)
    const { name, email, phone, subject, message, toEmail, appName } = body

    // Validate required fields
    if (!name || !email || !subject || !message) {
      throw createError({
        statusCode: 400,
        statusMessage: 'Missing required fields'
      })
    }

    // Create email transporter using app password for Gmail
    const transporter = nodemailer.createTransporter({
      service: 'gmail',
      auth: {
        user: 'globalepelepticc@gmail.com',
        pass: 'qmoa glal asot ogqx' // App password
      }
    })

    // Email content
    const mailOptions = {
      from: `${appName} <noreply@gecorwanda.org>`,
      to: toEmail,
      subject: `${appName} Contact Form: ${subject}`,
      html: `
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
          <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="margin: 0; font-size: 28px;">${appName}</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">New Contact Form Submission</p>
          </div>
          
          <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; border: 1px solid #e0e0e0;">
            <h2 style="color: #333; margin-top: 0;">Contact Information</h2>
            
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Name:</strong>
              <p style="margin: 5px 0; color: #333;">${name}</p>
            </div>
            
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Email:</strong>
              <p style="margin: 5px 0; color: #333;">${email}</p>
            </div>
            
            ${phone ? `
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Phone:</strong>
              <p style="margin: 5px 0; color: #333;">${phone}</p>
            </div>
            ` : ''}
            
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Subject:</strong>
              <p style="margin: 5px 0; color: #333;">${subject}</p>
            </div>
            
            <div style="margin-bottom: 20px;">
              <strong style="color: #666;">Message:</strong>
              <p style="margin: 5px 0; color: #333; line-height: 1.6;">${message}</p>
            </div>
            
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0; font-size: 12px; color: #666;">
              <p>This message was sent from the ${appName} contact form.</p>
              <p>Sent on: ${new Date().toLocaleString()}</p>
            </div>
          </div>
        </div>
      `
    }

    // Send email
    await transporter.sendMail(mailOptions)

    return {
      success: true,
      message: 'Email sent successfully'
    }

  } catch (error) {
    console.error('Email sending error:', error)
    throw createError({
      statusCode: 500,
      statusMessage: 'Failed to send email'
    })
  }
})
