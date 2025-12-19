<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<form id="uploadForm" enctype="multipart/form-data">
    <input type="file" id="pdfFile" name="pdfFile" accept="application/pdf">
    <button type="button" id="uploadBtn" class="btn btn-primary">Upload PDF</button>
</form>

<div class="progress mt-3" style="height: 25px;">
    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated"
        role="progressbar" style="width: 0%">0%</div>
</div>

<div id="status" class="mt-2"></div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("#uploadBtn").on("click", function() {
        const file = $("#pdfFile")[0].files[0];
        if (!file) {
            alert("Pilih file PDF terlebih dahulu!");
            return;
        }

        const chunkSize = 5 * 1024 * 1024; // 5MB
        const totalChunks = Math.ceil(file.size / chunkSize);
        let currentChunk = 0;

        // Cek ke server: chunk terakhir yang sudah diupload
        $.ajax({
            url: "proses/berkas/resume.php",
            type: "POST",
            data: {
                fileName: file.name
            },
            success: function(response) {
                currentChunk = parseInt(response) || 0;
                uploadNextChunk();
            }
        });

        function uploadNextChunk() {
            if (currentChunk >= totalChunks) {
                $("#status").html("<b>Upload selesai!</b>");
                $("#progressBar").removeClass("progress-bar-animated");
                return;
            }

            const start = currentChunk * chunkSize;
            const end = Math.min(start + chunkSize, file.size);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            formData.append("chunk", chunk);
            formData.append("index", currentChunk);
            formData.append("total", totalChunks);
            formData.append("fileName", file.name);

            $.ajax({
                url: "proses/berkas/.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let percent = Math.round(((currentChunk + 1) / totalChunks) * 100);
                    $("#progressBar").css("width", percent + "%").text(percent + "%");
                    $("#status").html("Chunk " + (currentChunk + 1) + " dari " + totalChunks + " selesai.");

                    currentChunk++;
                    uploadNextChunk();
                },
                error: function() {
                    $("#status").html("Terjadi kesalahan pada chunk " + (currentChunk + 1));
                }
            });
        }
    });
</script>