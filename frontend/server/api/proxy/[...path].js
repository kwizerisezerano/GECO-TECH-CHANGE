export default defineEventHandler(async (event) => {
  const path = getRouterParam(event, 'path')
  const config = useRuntimeConfig()
  const targetUrl = `${config.public.apiBase}/${path}`
  
  try {
    const response = await $fetch(targetUrl, {
      method: event.node.req.method,
      headers: event.node.req.headers,
      body: event.node.req.method !== 'GET' && event.node.req.method !== 'HEAD' 
        ? await readRawBody(event) 
        : undefined
    })
    return response
  } catch (error) {
    throw createError({
      statusCode: error.response?.status || 500,
      statusMessage: error.message || 'Proxy error'
    })
  }
})
