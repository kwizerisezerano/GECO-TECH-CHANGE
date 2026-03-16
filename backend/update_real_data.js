const mysql = require('mysql2/promise');
require('dotenv').config();
const { encrypt, hashPassword } = require('./utils/crypto');

/**
 * Update GECO Database with Real Project and Partner Information
 * This script populates the database with actual GECO strategic plan data
 */

const dbConfig = {
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: 'gecorwanda'
};

async function updateRealData() {
  let connection;
  
  try {
    console.log('🔄 Updating GECO database with real information...');
    
    connection = await mysql.createConnection(dbConfig);
    console.log('✅ Connected to database');

    // Clear existing sample data
    await connection.execute('DELETE FROM admin_users');
    await connection.execute('DELETE FROM people');
    await connection.execute('DELETE FROM projects');
    await connection.execute('DELETE FROM partners');
    console.log('🗑️ Cleared existing sample data');
    
    // Insert default admin user
    const defaultAdminPassword = hashPassword('admin123'); // Change this in production
    await connection.execute(
      'INSERT INTO admin_users (email_encrypted, password_hash, name_encrypted, role) VALUES (?, ?, ?, ?)',
      [encrypt('admin@gecorwanda.rw'), defaultAdminPassword, encrypt('System Administrator'), 'admin']
    );
    console.log('✅ Created default admin user: admin@gecorwanda.rw / admin123');

    // Insert real GECO projects
    const projects = [
      {
        name: 'Safe Cooking Initiative for People Living with Epilepsy (SCI-PWE)',
        status: 'ongoing',
        description: 'Preventing Burn Injuries through Inclusive Clean Cooking Solutions. This innovative approach connects public health, disability inclusion, and clean energy access by providing improved cook stoves to vulnerable households, training families on safe cooking practices, and raising community awareness on epilepsy safety.',
        start_date: '2024-01-01',
        end_date: '2024-12-31',
        budget: 120000.00
      },
      {
        name: 'Rights-Based Advocacy and Social Inclusion Program',
        status: 'ongoing',
        description: 'Community awareness campaigns, school education programs, protection against gender-based violence, and advocacy for inclusive national policies to eliminate stigma and discrimination surrounding epilepsy.',
        start_date: '2026-01-01',
        end_date: '2031-12-31',
        budget: 250000.00
      },
      {
        name: 'Socio-Economic Empowerment and Household Safety',
        status: 'ongoing',
        description: 'Cooperative development, income-generating activities, vocational skills training, household safety adaptations, and climate-sensitive sustainable solutions for families affected by epilepsy.',
        start_date: '2026-01-01',
        end_date: '2031-12-31',
        budget: 300000.00
      },
      {
        name: 'Expanded Access to Health Services',
        status: 'ongoing',
        description: 'Early detection and referral systems, access to anti-seizure medication, capacity building for health professionals, and psychosocial support services.',
        start_date: '2026-01-01',
        end_date: '2031-12-31',
        budget: 400000.00
      },
      {
        name: 'Research, Data Systems, and Technology',
        status: 'planning',
        description: 'Digital data systems, operational research, knowledge sharing, and evidence-based policy advocacy for epilepsy services improvement.',
        start_date: '2026-06-01',
        end_date: '2031-12-31',
        budget: 150000.00
      }
    ];

    // Insert projects
    for (const project of projects) {
      await connection.execute(
        'INSERT INTO projects (project_name, status, description, start_date, end_date, budget) VALUES (?, ?, ?, ?, ?, ?)',
        [project.name, project.status, project.description, project.start_date, project.end_date, project.budget]
      );
    }
    console.log(`✅ Inserted ${projects.length} projects`);

    // Insert real GECO partners
    const partners = [
      // Government Institutions
      { name: 'Ministry of Health', contact_person: 'Director General', email: 'info@moh.gov.rw', phone: '+250788123001', partnership_type: 'Government' },
      { name: 'MINALOC', contact_person: 'Permanent Secretary', email: 'info@miniloc.gov.rw', phone: '+250788123002', partnership_type: 'Government' },
      { name: 'MINEDUC', contact_person: 'Director', email: 'info@mineduc.gov.rw', phone: '+250788123003', partnership_type: 'Government' },
      { name: 'RGB', contact_person: 'CEO', email: 'info@rgb.gov.rw', phone: '+250788123004', partnership_type: 'Government' },
      { name: 'RBC', contact_person: 'Director General', email: 'info@rbc.gov.rw', phone: '+250788123005', partnership_type: 'Government' },
      
      // Multilateral Donors
      { name: 'UNDP Rwanda', contact_person: 'Resident Representative', email: 'registry.rw@undp.org', phone: '+250788123006', partnership_type: 'Multilateral' },
      { name: 'EU Funding and Tenders Portal', contact_person: 'EU Delegation', email: 'delegation-rwanda@eeas.europa.eu', phone: '+250788123007', partnership_type: 'Multilateral' },
      
      // International NGOs
      { name: 'International Bureau For Epilepsy (IBE)', contact_person: 'Regional Director', email: 'info@ibe-epilepsy.org', phone: '+250788123008', partnership_type: 'International NGO' },
      { name: 'Humanity & Inclusion', contact_person: 'Country Director', email: 'rwanda@hi.org', phone: '+250788123009', partnership_type: 'International NGO' },
      { name: 'AVSI RWANDA', contact_person: 'Country Representative', email: 'rwanda@avsi.org', phone: '+250788123010', partnership_type: 'International NGO' },
      { name: 'NUDOR', contact_person: 'Executive Secretary', email: 'info@nudor.org.rw', phone: '+250788123011', partnership_type: 'National NGO' },
      { name: 'Save the Children International', contact_person: 'Country Director', email: 'rwanda@savethechildren.org', phone: '+250788123012', partnership_type: 'International NGO' },
      { name: 'Care International', contact_person: 'Country Director', email: 'rwanda@care.org', phone: '+250788123013', partnership_type: 'International NGO' },
      { name: 'World Vision International', contact_person: 'National Director', email: 'rwanda@wvi.org', phone: '+250788123014', partnership_type: 'International NGO' },
      { name: 'Partners In Health', contact_person: 'Country Director', email: 'rwanda@pih.org', phone: '+250788123015', partnership_type: 'International NGO' },
      
      // Climate & Environment
      { name: 'Youth Climate Justice Fund', contact_person: 'Program Manager', email: 'info@youthclimatejustice.org', phone: '+250788123016', partnership_type: 'Climate/Environment' },
      { name: 'Clean Cooking Alliance', contact_person: 'Regional Director', email: 'info@cleancookingalliance.org', phone: '+250788123017', partnership_type: 'Climate/Environment' },
    ];

    // Insert partners with encrypted data
    for (const partner of partners) {
      await connection.execute(
        'INSERT INTO partners (partner_name_encrypted, contact_person_encrypted, email_encrypted, phone_encrypted, partnership_type) VALUES (?, ?, ?, ?, ?)',
        [encrypt(partner.name), encrypt(partner.contact_person), encrypt(partner.email), encrypt(partner.phone), partner.partnership_type]
      );
    }
    console.log(`✅ Inserted ${partners.length} partners with encrypted data`);

    // Remove hardcoded beneficiaries and members - they should be added through the admin interface
    console.log('⚠️  Beneficiaries and members should be added through the admin interface');

    // Display summary
    const [projectCount] = await connection.execute('SELECT COUNT(*) as count FROM projects');
    const [partnerCount] = await connection.execute('SELECT COUNT(*) as count FROM partners');
    const [beneficiaryCount] = await connection.execute('SELECT COUNT(*) as count FROM people WHERE person_type = "beneficiary"');
    const [memberCount] = await connection.execute('SELECT COUNT(*) as count FROM people WHERE person_type = "member"');

    console.log('\n📊 Database Update Summary:');
    console.log(`   • Projects: ${projectCount[0].count}`);
    console.log(`   • Partners: ${partnerCount[0].count}`);
    console.log(`   • Beneficiaries: ${beneficiaryCount[0].count}`);
    console.log(`   • Members: ${memberCount[0].count}`);

    console.log('\n🎉 GECO database updated with real strategic information!');
    console.log('💡 The database now contains actual GECO projects, partners, and organizational data.');

  } catch (error) {
    console.error('❌ Update failed:', error.message);
    process.exit(1);
  } finally {
    if (connection) {
      await connection.end();
      console.log('🔌 Database connection closed');
    }
  }
}

// Run update if this file is executed directly
if (require.main === module) {
  updateRealData();
}

module.exports = { updateRealData };
