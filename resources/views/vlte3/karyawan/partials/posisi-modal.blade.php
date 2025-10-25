<div class="modal fade" id="modalPosisiKaryawan" tabindex="-1" aria-labelledby="modalPosisiKaryawanLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary text-white">
        <h5 class="modal-title" id="modalPosisiKaryawanLabel">Atur Posisi Karyawan</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-light">
        <div class="form-group mb-3">
          <label for="filterKategoriPosisi" class="font-weight-bold">Filter Kategori</label>
          <select id="filterKategoriPosisi" class="form-control shadow-sm w-auto d-inline-block ml-2">
            <option value="">Semua Kategori</option>
            {{-- Kategori akan diisi via JS --}}
          </select>
        </div>
        <div id="posisiKaryawanList" class="karyawan-grid">
          {{-- Karyawan cards akan diisi via JS --}}
        </div>
      </div>
      <div class="modal-footer bg-white">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="btnSimpanPosisiKaryawan">Simpan Posisi</button>
      </div>
    </div>
  </div>
</div>

<template id="karyawanCardTemplate">
  <div class="karyawan-card-grid animate-card" draggable="true">
    <div class="foto-wrap">
      <img src="" alt="Foto" class="foto-karyawan shadow">
    </div>
    <div class="info-wrap">
      <div class="nama font-weight-bold mb-1"></div>
      <div class="staff text-info mb-1"></div>
      <div class="kategori text-primary mb-1"></div>
      <div class="nik text-muted mb-2"></div>
      <div class="posisi-badge"></div>
    </div>
  </div>
</template>

<style>
.karyawan-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 18px 18px;
  min-height: 120px;
  margin-bottom: 10px;
  transition: grid-template-columns 0.2s;
}
.karyawan-card-grid {
  background: #fff;
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(44,62,80,0.13), 0 1.5px 4px rgba(44,62,80,0.08);
  padding: 22px 14px 16px 14px;
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;
  position: relative;
  transition: box-shadow 0.25s, transform 0.18s, background 0.18s;
  will-change: box-shadow, transform, background;
  min-height: 180px;
  overflow: hidden;
  outline: none;
}
.karyawan-card-grid:active, .karyawan-card-grid.dragging {
  box-shadow: 0 8px 32px rgba(44,62,80,0.18), 0 2px 8px rgba(44,62,80,0.10);
  transform: scale(1.03) rotate(-1deg);
  z-index: 2;
}
.karyawan-card-grid.selected {
  background: linear-gradient(90deg,#e3e8f0 60%,#f8fafc 100%);
  box-shadow: 0 8px 32px rgba(44,62,80,0.18), 0 2px 8px rgba(44,62,80,0.10);
  outline: 2.5px solid #2d7be5;
  transform: scale(1.04);
  z-index: 3;
}
.karyawan-card-grid.animate-card {
  animation: fadeInCard 0.45s cubic-bezier(.4,1.4,.6,1) both;
}
@keyframes fadeInCard {
  0% { opacity: 0; transform: translateY(30px) scale(0.97); }
  100% { opacity: 1; transform: none; }
}
.karyawan-card-grid .foto-wrap {
  width: 64px;
  height: 64px;
  margin-bottom: 10px;
  border-radius: 50%;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(44,62,80,0.10);
}
.karyawan-card-grid .foto-karyawan {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: 2.5px solid #e3e3e3;
  background: #f8f9fa;
}
.karyawan-card-grid .info-wrap {
  text-align: center;
  width: 100%;
}
.karyawan-card-grid .nama {
  font-size: 1.13em;
  letter-spacing: 0.01em;
}
.karyawan-card-grid .kategori {
  font-size: 0.98em;
  color: #2d7be5;
  font-weight: 500;
}
.karyawan-card-grid .nik {
  font-size: 0.93em;
  color: #b0b0b0;
}
.karyawan-card-grid .posisi-badge {
  position: absolute;
  top: 10px;
  right: 16px;
  background: linear-gradient(90deg,#e3e8f0 60%,#f8fafc 100%);
  color: #3b3b3b;
  font-size: 0.89em;
  border-radius: 12px;
  padding: 2.5px 13px;
  font-weight: 600;
  box-shadow: 0 1px 2px rgba(44,62,80,0.07);
  letter-spacing: 0.01em;
}
.karyawan-card-grid .posisi-badge:before {
  content: '#';
  color: #2d7be5;
  font-weight: bold;
  margin-right: 2px;
}
</style>
