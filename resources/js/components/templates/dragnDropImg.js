export const dragnDropImg =  {
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
    },
    methods: {
        handleFileUpload(file) {
            this.errors = [];
            this.loading = !this.loading;
            let formData = new FormData();
            formData.append("photo", file);
            formData.append("_method", 'PUT');
            axios
                .post(`/api/bio/${this.bio.id}`, formData)
                .then((res) => {
                    if (res.data.status == 200) {
                        this.loading = !this.loading;
                        this.uploaded = true;
                        const image = document.getElementById("uploadedImage");
                        image.src = URL.createObjectURL(file);
                        // this.showCropper = false;
                    }
                })
                .catch((err) => {
                    this.loading = !this.loading;
                    if (err) {
                        this.errors = err.response;
                    }
                });
        },
    }
}