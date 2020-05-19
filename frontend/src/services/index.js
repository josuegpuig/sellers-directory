export default {
  login(params) {
    return window.axios.post('/auth/login', params)
      .then(token => {
        console.log(token);
        token = token.data;
        let expiration = new Date();
        expiration.setSeconds(expiration.getSeconds() + token.expires_in);
        let token_data = {
          access_token: token.access_token,
          expiration: expiration
        }
        localStorage.setItem('token', JSON.stringify(token_data));
        return { status: true }
      }).catch(error => {
        console.log(error.response);
        return error.response.data;
      })
  },
}