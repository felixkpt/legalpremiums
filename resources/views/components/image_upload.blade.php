<div class="">
    <div class="max-w-2xl rounded-lg shadow-xl bg-gray-50">
        <div class="m-4">
            <div class="flex items-center justify-center w-full h-64">
                <label id="preview"
                    class="bg-light"
                    style="height:inherit;background-image: url('{{ @$image }}');background-repeat: no-repeat;background-size: cover;width:250px;min-height:150px">
                    <div class="d-flex pt-7 mb-1">
                       
                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                            Upload company logo
                        </p>
                    </div>
                    <input type="file" name="{{ $image_name ?? 'image' }}" class="d-none" id="imageInput" accept="image/*" />
                </label>
            </div>
        </div>
    </div>
</div> 
<script>
    const image_input = document.querySelector("#imageInput");
    image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        document.querySelector("#preview").style.backgroundImage = `url(${uploaded_image})`;
    });
    reader.readAsDataURL(this.files[0]);
    });
</script>