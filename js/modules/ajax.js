export class Ajax {
    static getFetchOptions(method, data) {
        const headers = {
            'Content-Type': 'application/json', // Set the Content-Type header for JSON data
            // Add any other headers as needed, e.g., authentication tokens, API keys, etc.
        };
        const options = {
            method,
            headers,
        };
    
        if (data) {
            options.body = JSON.stringify(data);
        }
    
        return options;
    }

    static get(url) {
        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            });
    }


    static post(url, data) {
        const options = Ajax.getFetchOptions('POST', data);
        return fetch(url, options)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            });
    }

    static postFormData(url, formData) {
        return fetch(url, {method: 'POST', body: formData}).then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        });
    }
}
