import Axios from 'axios';

const Ajax = Axios.create({
    baseURL: ajax.url
});

export default Ajax;