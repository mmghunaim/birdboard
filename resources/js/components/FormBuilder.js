class FormBuilder{
    constructor(data){
        this.originalData = {};
        //shallow merge
        Object.assign(this.originalData, data);

        //deep merge
        this.originalData = JSON.parse(JSON.stringify(data));

        Object.assign(this, data);

        this.errors = {};
        this.submitted = false;
    }

    data(){
        let data = {};

        for (let attribute in this.originalData) {
            data[attribute] = this[originalData];
        }
        return data;

        // return Object.keys(this.originalData).reduce((data, attribute) => {
        //     data[attribute] = this[originalData];
        //     return data;
        // }, {})
    }

    submit(endpoint, requestType = 'post'){
        return axios.requestType(endpoint, this.data())
                    .catch(this.onFail.bind(this))
                    .then(this.onSuccess.bind(this));
    }

    onFail(error){
        this.errors = error.response.data.errors;
        this.submitted = false;
        throw error;
    }

    onSuccess(response){
        this.submitted = true;
        this.errors = {};

        return response;
    }

    reset(){
        Object.assign(this, this.originalData);
    }
}

export default FormBuilder;