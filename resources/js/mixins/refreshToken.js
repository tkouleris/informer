export default {
    methods: {
        refreshToken(response, callback){
            console.log(response.data.success === false && response.data.status == 'expired');
            if(response.data.success === false && response.data.status == 'expired'){
                localStorage.token = response.data.token;
                callback();
                return;
            }
            return;
        }
    },
}
