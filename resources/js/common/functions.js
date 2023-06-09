import Swal from "sweetalert2";

export const swal = Swal.mixin({});

export const openSwal = async ({titleSwal, callbackAPIs, mode, response, showOnlyError}) => {
    const MySwal = swal;
    if (mode === 'loading') return await MySwal.fire({
        title: titleSwal,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: async () => {
            MySwal.showLoading();
            return await Promise.all(callbackAPIs.map(async (callbackAPI) => await callbackAPI())).then(() => MySwal.close());
        }
    });
    else if (mode === 'verifyStatus' && (response && response.message)) {
        const options = {
            html: response.errors ? Object.values(response.errors).reduce((errors, currentError) => errors + currentError.reduce((specificErrors, currentSpecificError) => specificErrors + `<div>${currentSpecificError}</div>`, ''), '') : response.message,
            confirmButtonText: 'Aceptar'
        };
        let successStatus = false;
        if (response.status >= 100 && response.status <= 199) {
            successStatus = true;
            options['title'] = 'Información';
            options['icon'] = 'info';
        } else if (response.status >= 200 && response.status <= 299) {
            successStatus = true;
            options['title'] = '¡Éxito!';
            options['icon'] = 'success';
        } else if (response.status >= 400 && response.status <= 499) {
            successStatus = false;
            options['title'] = '¡Error!';
            options['icon'] = 'error';
        } else if (response.status >= 500 && response.status <= 599) {
            successStatus = false;
            options['title'] = '¡Error del servidor!';
            options['html'] = 'Por favor contactar con el Administrador';
            options['icon'] = 'error';
        }
        if (showOnlyError && !successStatus) return await MySwal.fire(options).then(() => options['icon']);
        else if (showOnlyError && successStatus) return options['icon'];
        else return await MySwal.fire(options).then(() => options['icon']);
    }
}

export const openSwalVerifyStatus = (response, showOnlyError = false) => openSwal({
    response,
    showOnlyError,
    mode: 'verifyStatus'
});

export const consumeAPI = async (CSRF, url, method, data = undefined) => {
    const init = {
        method,
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json',
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
        },
        credentials: "include",
        body: data ? JSON.stringify(data) : undefined
    };
    if (CSRF) init['headers']['X-CSRF-TOKEN'] = CSRF;
    return await fetch(url, init).then(response => response.json().then(res => ({status: response.status, ...res})).catch(() => response)).catch(error => console.error(error));
}
