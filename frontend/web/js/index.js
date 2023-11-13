const RANDOM_IMAGE_URL = "https://picsum.photos/600/500"

const fetchRandomImage = async () => {
    let response = await fetch(RANDOM_IMAGE_URL);

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }

    return {id: response.url.split('/')[4], objectUrl: URL.createObjectURL(await response.blob())}
}

const updateRandomImageOnPage = async () => {
    let newImage

    while (!newImage) {
        let fetchedImg = await fetchRandomImage();

        let response = await fetch(`/random-image-decision/check-image-id?id=${fetchedImg.id}`)
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        let checkResult = await response.json();

        if (!checkResult.exists) {
            newImage = fetchedImg;
        }
    }

    let randomImageElement = $("#random-image");
    randomImageElement.attr("src", newImage.objectUrl);
    randomImageElement.data("id", newImage.id);
}

const saveRandomImageDecision = async (id, decision) => {
    let response = await fetch('/random-image-decision/save', {
        method: 'POST', headers: {
            "Content-Type": "application/json",
        }, body: JSON.stringify({image_id: id, result: decision, [yii.getCsrfParam()]: yii.getCsrfToken()}),
    });
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
}

$(() => {
    updateRandomImageOnPage()
})

let approveBtn = $("#approve-btn");
let rejectBtn = $("#reject-btn");

approveBtn.click(async function () {
    $(this).prop("disabled", true);
    rejectBtn.prop("disabled", true);
    let imageId = $("#random-image").data("id");

    saveRandomImageDecision(imageId, true)

    await updateRandomImageOnPage()
    $(this).prop("disabled", false);
    rejectBtn.prop("disabled", false);
})

rejectBtn.click(async function () {
    $(this).prop("disabled", true);
    approveBtn.prop("disabled", true);
    let imageId = $("#random-image").data("id");

    saveRandomImageDecision(imageId, false)

    await updateRandomImageOnPage()
    $(this).prop("disabled", false);
    approveBtn.prop("disabled", false);
})
