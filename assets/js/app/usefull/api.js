import Axios from 'axios';

/*
 * Create a Api object with Axios and
 * configure it for the WordPRess Rest Api.
 *
 * The 'mynamespace' object is injected into the page
 * using the WordPress wp_localize_script function.
 */
const Api = Axios.create({
    baseURL: neurocirugiaArgentina.rootapiurl,
    headers: {
        'content-type': 'application/json',
        'X-WP-Nonce': neurocirugiaArgentina.nonce
    }
});

export default Api;