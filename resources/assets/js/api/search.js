import axios from 'axios'

const SEARCH_ENDPOINT = '/search/autocomplete';

export default {
  search(keyword) {
    return axios.get(SEARCH_ENDPOINT, {
      params: {
        query: keyword
      }
    })
      .then(({data}) => {
        return data
      })
  }
}