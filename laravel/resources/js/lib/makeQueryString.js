export function makeQueryString(e) {
    const formData = Object.entries(Object.fromEntries(new FormData(e.target)));
    let queryArray = [];

    formData.forEach(([field, value]) => {
        if (value !== "") {
            if (field === "orderBy") {
                queryArray.push(`sort=${value}`);
            } else {
                queryArray.push(`like=${field},${value}`);
            }
        }
    });

    return "?" + queryArray.join("&");
}
