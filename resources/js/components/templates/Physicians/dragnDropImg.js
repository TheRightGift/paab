export default {
    mounted() {
        const imageContainer = document.querySelector(".imageContainer");
        if (imageContainer !== null) {
            imageContainer.addEventListener("dragover", (e) => {
                e.preventDefault();
                imageContainer.classList.add("dragging");
            });

            imageContainer.addEventListener("dragleave", () => {
                imageContainer.classList.remove("dragging");
            });

            imageContainer.addEventListener("drop", (e) => {
                e.preventDefault();
                imageContainer.classList.remove("dragging");
                this.handleFileUpload(e.dataTransfer.files[0]);
            });

            const fileInput = document.getElementById("file-input");
                fileInput.addEventListener("change", (e) => {
                this.handleFileUpload(e.target.files[0]);
            });
        }
    }
}