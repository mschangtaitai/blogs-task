import axios from 'axios';

//API Instances declare here to use them as singleton
let apiInstance;

const useAxios = () => {
    //This should be invoked here, because outside can't get initialized

    //We check if we need to create the instance or if we can use the old one
    if (!apiInstance) {
        apiInstance = axios.create({
            baseURL: "http://localhost:80/",
            headers: {
                common: {
                    Accept: 'application/json'
                }
            }
        })
        apiInstance.defaults.withCredentials = true;
        apiInstance.defaults.withXSRFToken = true;

    }

    return apiInstance;
}


export default useAxios;