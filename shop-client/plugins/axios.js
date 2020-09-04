export default function ({
  $axios,
  redirect,
  store
}) {
  $axios.onRequest(config => {
    config.headers.common['Accept'] = 'application/json';
    console.log('Making request to ' + config.url);
  });

  $axios.onResponse(res => {
    console.log('onResponse Status => ', res.status);
    return res;
  });

  $axios.onError(error => {
    const code = parseInt(error.response && error.response.status);
    if (code === 400) {
      redirect('/400');
    } else if (code === 403) {
      redirect('/403');
    } else if (code === 404) {
      redirect('/404');
    }
    // else {
    //   store.$toast.error(error.response.data.message)
    // }
  });
}
