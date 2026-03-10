export default defineEventHandler(async (event) => {
  // Mock stats data - you can replace this with actual data from your database
  return {
    beneficiaries: 600000,
    projects: 150,
    partners: 50,
    donations: 2500
  }
})
