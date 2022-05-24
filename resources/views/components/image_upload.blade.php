<div class="">
    <div class="max-w-2xl rounded-lg shadow-xl bg-gray-50">
        <div class="m-4">
            <div class="flex items-center justify-center w-full h-64">
                <style>
                    #preview {
                        border:dashed lightblue 2px;
                        padding: 3px;
                        max-height: 200px;
                        width:250px;
                        height:150px;
                    }
                    #preview .inner {
                        opacity: .7;
                    }
                    #preview .inner:hover {
                        opacity: 1;
                    }
                </style>
                <label class="mx-auto" id="preview" style="background: url('{{ @$image }}'), #ecf0f1;background-repeat: no-repeat;background-size: contain;background-position: center center;">
                        <div class="inner d-flex h-100 align-items-center justify-content-center pt-7 mb-1">
                            <div class="w-full">
                                <div class="inline text-center">
                                    <div><i class="ti ti-upload rounded" style="font-size:x-large;background:#dee2e6;padding:1px"></i></div>
                                    <div><span class="rounded" style="font-size:large;background:#dee2e6;padding:1px">Upload company logo</span></div>
                                </div>
                            </div>
                        </div>
                    <input type="file" name="{{ $image_name ?? 'image' }}" class="hidden" id="imageInput" accept="image/*" />
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