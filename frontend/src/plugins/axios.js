"use strict";

import Vue from 'vue';
import axios from "axios";

// Full config:  https://github.com/axios/axios#request-config
// axios.defaults.baseURL = process.env.baseURL || process.env.apiUrl || '';
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
// axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

let config = {
  baseURL: process.env.VUE_APP_BASEURL || process.env.apiUrl || ""
  // timeout: 60 * 1000, // Timeout
  // withCredentials: true, // Check cross-site Access-Control
};

const _axios = axios.create(config);

// for multiple requests
let isRefreshing = false;
let failedQueue = [];

const processQueue = (error, token = null) => {
  failedQueue.forEach(prom => {
    if (error) {
      prom.reject(error);
    } else {
      prom.resolve(token);
    }
  })

  failedQueue = [];
}

_axios.interceptors.request.use(
  function (config) {
    // Do something before request is sent
    let item = localStorage.getItem('token');
    if (item) {
      let token = JSON.parse(localStorage.getItem('token')).access_token;
      config.headers.authorization = `Bearer ${token}`;
    }
    
    return config;
  },
  function (error) {
    // Do something with request error
    return Promise.reject(error);
  }
);

// Add a response interceptor
_axios.interceptors.response.use(
  function (response) {
    // Do something with response data
    return response;
  },
  function (error) {
    // TODO: check interceptor logic
    // Do something with response error
    const originalRequest = error.config;
    let item = localStorage.getItem('token');

    if (error.response.status === 400 && error.response.data.error == 'Unauthorized' && !originalRequest._retry && item) {
      if (isRefreshing) {
        return new Promise(function (resolve, reject) {
          failedQueue.push({ resolve, reject })
        }).then(token => {
          originalRequest.headers['Authorization'] = 'Bearer ' + token;
          return _axios(originalRequest);
        }).catch(err => {
          return Promise.reject(err);
        })
      }

      originalRequest._retry = true;
      isRefreshing = true;

      let token = JSON.parse(localStorage.getItem('token'));
      let expiration = token.expiration;

      if (new Date(expiration) < new Date()) {
        //return new Promise(function (resolve, reject) {
          return _axios.get('http://localhost:8000/api/auth/refresh').then(response => {
            let token = response.data;
            let expiration = new Date();
            expiration.setSeconds(expiration.getSeconds() + token.expires_in);
            let token_data = {
              access_token: token.access_token,
              expiration: expiration
            }
            localStorage.setItem('token', JSON.stringify(token_data));
            error.config.headers.authorization = `Bearer ${token_data.access_token}`;
            processQueue(null, token_data.access_token);
            //resolve(_axios(error.config));
            return _axios(error.config);
          }).catch(err => {
            processQueue(err, null);
            //reject(err);
          })
        //})
        //.then(() => { isRefreshing = false });

      }
    }
    return Promise.reject(error);
  }
);

Plugin.install = function (Vue) {
  Vue.axios = _axios;
  window.axios = _axios;
  Object.defineProperties(Vue.prototype, {
    axios: {
      get() {
        return _axios;
      }
    },
    $axios: {
      get() {
        return _axios;
      }
    },
  });
};

Vue.use(Plugin)

export default Plugin;
