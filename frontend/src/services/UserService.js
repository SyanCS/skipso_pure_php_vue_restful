import ApiService from '@/services/ApiService.js'

export default {
  get(id) {
    return ApiService.apiCall().get(`users/${id}`)
  },
	getAll() {
    return ApiService.apiCall().get(`users/`)
  },
  getAllWithCompany() {
    return ApiService.apiCall().get(`users/getallwithcompany`)
  },
  post(postData) {
    return ApiService.apiCall().post(`/users/`, JSON.stringify(postData));
  },
}