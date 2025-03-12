/**
 * Download file data
 **/
export function forceFileDownload(data, fileName) {
  const url = window.URL.createObjectURL(new Blob([data]))
  const link = document.createElement('a')
  link.href = url
  link.setAttribute('download', fileName)
  document.body.appendChild(link)
  link.click()
}

/**
 * Handle api error response
 **/
export function hadleResponseError(error) {
    let message = null;
    let data = null;
    if (error.response.data.message) {
        message = error.response.data.message;
    } else if (error.message) {
        message = error.message;
    }

    if (!message) {
        message = 'Error during API request';
    }

    if (error.response.data.data) {
        data = error.response.data.data;
    }
    
    //alert(message);
    console.log(message);

    return {'message': message, 'data': data};
}

/**
 * Handle api error response
 **/
export function getCsrfToken() {
    return document.head.querySelector('meta[name="csrf-token"]').content;
}