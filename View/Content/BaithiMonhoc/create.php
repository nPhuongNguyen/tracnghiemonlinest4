<h1 class="text-center text-gradient mt-4 fw-bold">✏️ Create Bài thi & Câu hỏi</h1>

<div class="container mt-4">
    <div class="card shadow-lg p-4 rounded-4">
        <form action="index.php?controller=BaithiMonhoc&action=Create" method="POST">
            <div class="mb-3">
                <label for="id_baithi" class="form-label">Bài thi:</label>
                <select id="id_baithi" name="id_baithi" class="form-control mb-3">
                    <option value="">-- Chọn bài thi --</option>
                    <?php foreach ($Baithitracnghiems as $Baithitracnghiem): ?>
                        <option value="<?php echo $Baithitracnghiem->id_baithi; ?>">
                            <?php echo htmlspecialchars($Baithitracnghiem->ten_baithi); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_monhoc" class="form-label">Môn học:</label>
                <select id="id_monhoc" name="id_monhoc" class="form-control mb-3">
                    <option value="">-- Chọn môn học --</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="create" class="btn btn-primary px-4">
                    <i class="bi bi-plus-circle"></i> Thêm mới
                </button>
                <a href="?controller=BaithiMonhoc&action=index" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("id_baithi").addEventListener("change", function () {
    let idBaithi = this.value;
    let selectMonhoc = document.getElementById("id_monhoc");

    selectMonhoc.innerHTML = "<option value=''>-- Chọn môn học --</option>"; // Xóa danh sách cũ

    if (idBaithi) {
        fetch("index.php?controller=BaithiMonhoc&action=getAvailableQuestions&id_baithi=" + idBaithi)
            .then(response => response.json())
            .then(data => {
                data.forEach(q => {
                    let option = document.createElement("option");
                    option.value = q.id_monhoc;
                    option.textContent = q.name_monhoc;
                    selectMonhoc.appendChild(option);
                });
            })
            .catch(error => console.error("Lỗi:", error));
    }
});
</script>
