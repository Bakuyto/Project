<div class="container-fluid fixed-bottom bg-white px-5" style="height: 60px; display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; align-items: center;">
        <button class="btn btn-primary me-1" onclick="$('#productStatusModal').modal('show')">Done</button>
    </div>
    <div style="display: flex; align-items: center;">
        <div class="page-of mt-1 me-1">Page <span id="current-page">1</span> of <span id="total-pages">1</span></div>
        <button class="btn me-1 text-white" id="prev-btn" style="background-color: #28ACE8; height: 40px;">Prev</button>
        <input class="me-1 rounded text-center" type="number" placeholder="1" id="page-number" disabled style="width: 50px; height: 40px;">
        <button class="btn text-white" id="next-btn" style="background-color: #28ACE8; height: 40px;">Next</button>
    </div>
</div>





