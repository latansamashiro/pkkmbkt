@extends('layouts.admin.main')
@section('content')
  <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
    <div>
      <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Administrasi</p>
      <h2 class="font-serif text-xl font-bold text-[var(--navy-900)] md:text-2xl">Kelola Pengguna</h2>
    </div>
    <div>
      <button id="btnTambah" type="button"
        class="inline-flex items-center gap-2 rounded-lg bg-[var(--navy-900)] px-4 py-2.5 text-sm font-bold text-white hover:opacity-90">
        <i data-lucide="user-plus" class="h-4 w-4"></i>
        Tambah Pengguna
      </button>
    </div>
  </div>

  <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-col gap-3 border-b border-slate-200 p-4 md:flex-row md:items-center md:justify-between">
      <div class="flex flex-col gap-2 sm:flex-row">
        <select id="filterRole"
          class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 outline-none focus:border-[var(--teal-500,#0d9488)]">
          <option value="">Semua Role</option>
          @foreach ($roles as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
          @endforeach
        </select>
        <select id="filterStatus"
          class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 outline-none focus:border-[var(--teal-500,#0d9488)]">
          <option value="">Semua Status</option>
          <option value="aktif">Aktif</option>
          <option value="nonaktif">Nonaktif</option>
        </select>
      </div>
      <div class="relative">
        <i data-lucide="search"
          class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
        <input type="text" id="searchPengguna" placeholder="Cari nama atau email..."
          class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-3 text-sm outline-none focus:border-[var(--teal-500,#0d9488)] md:w-64" />
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm">
        <thead class="border-b border-slate-200 bg-slate-50 text-xs font-bold uppercase tracking-wide text-slate-500">
          <tr>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Role</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody id="tabelPengguna" class="divide-y divide-slate-100"></tbody>
      </table>
    </div>

    <div class="flex flex-col items-center justify-between gap-3 border-t border-slate-200 p-4 sm:flex-row">
      <p id="paginationInfo" class="text-xs font-medium text-slate-400">Showing 0 of 0</p>
      <div id="paginationBtns" class="flex items-center gap-1"></div>
    </div>
  </div>

  <!-- ===== MODAL TAMBAH / EDIT PENGGUNA ===== -->
  <div id="modalForm" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-lg rounded-2xl bg-white p-5 shadow-xl">
      <div class="mb-4 flex items-start justify-between">
        <div>
          <h3 id="modalFormTitle" class="font-serif text-lg font-bold text-[var(--navy-900)]">Tambah Pengguna</h3>
          <p class="text-xs text-slate-400">Buat akun pengguna baru untuk sistem PKKMB-KT.</p>
        </div>
        <button id="btnCloseForm" type="button" aria-label="Tutup"
          class="grid h-8 w-8 place-items-center rounded-full text-slate-400 hover:bg-slate-100">
          <i data-lucide="x" class="h-4 w-4"></i>
        </button>
      </div>
      <form id="formPengguna">
        <p id="formError" class="mb-3 hidden rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600"></p>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div class="sm:col-span-2">
            <label for="inputNama" class="mb-1 block text-xs font-semibold text-slate-500">Nama Lengkap</label>
            <input type="text" id="inputNama" placeholder="Contoh: Deni Saputra" required
              class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[var(--teal-500,#0d9488)]" />
          </div>
          <div class="sm:col-span-2">
            <label for="inputEmail" class="mb-1 block text-xs font-semibold text-slate-500">Email</label>
            <input type="email" id="inputEmail" placeholder="nama@pkkmb.ac.id" required
              class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[var(--teal-500,#0d9488)]" />
          </div>
          <div id="fieldPassword" class="sm:col-span-2">
            <label for="inputPassword" class="mb-1 block text-xs font-semibold text-slate-500">Password</label>
            <div class="relative">
              <input type="password" id="inputPassword" placeholder="Minimal 8 karakter"
                class="w-full rounded-lg border border-slate-200 px-3 py-2.5 pr-10 text-sm outline-none focus:border-[var(--teal-500,#0d9488)]" />
              <button type="button" id="btnTogglePw"
                class="absolute right-2 top-1/2 grid h-7 w-7 -translate-y-1/2 place-items-center rounded-full text-slate-400 hover:bg-slate-100">
                <i data-lucide="eye" class="h-4 w-4"></i>
              </button>
            </div>
            <p id="hintPassword" class="mt-1 text-xs text-slate-400">Kosongkan saat edit jika tidak ingin mengubah
              password.</p>
          </div>
          <div>
            <label for="inputRole" class="mb-1 block text-xs font-semibold text-slate-500">Role</label>
            <select id="inputRole" required
              class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[var(--teal-500,#0d9488)]">
              @foreach ($roles as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="mb-1 block text-xs font-semibold text-slate-500">Status</label>
            <div class="flex items-center gap-4 pt-2">
              <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-600">
                <input type="radio" name="statusPengguna" value="aktif" checked
                  class="h-4 w-4 accent-[var(--teal-500,#0d9488)]" />
                Aktif
              </label>
              <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-600">
                <input type="radio" name="statusPengguna" value="nonaktif"
                  class="h-4 w-4 accent-[var(--coral-500,#e0665a)]" />
                Nonaktif
              </label>
            </div>
          </div>
        </div>
        <div class="mt-5 flex items-center justify-end gap-2">
          <button type="button" id="btnBatalForm"
            class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50">Batal</button>
          <button type="submit" id="btnSimpanForm"
            class="rounded-lg bg-[var(--navy-900)] px-4 py-2.5 text-sm font-bold text-white hover:opacity-90 disabled:opacity-50">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ===== MODAL DETAIL PENGGUNA ===== -->
  <div id="modalDetail" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
    <div class="w-full max-w-md rounded-2xl bg-white p-5 shadow-xl">
      <div class="mb-4 flex items-start justify-between">
        <h3 class="font-serif text-lg font-bold text-[var(--navy-900)]">Detail Pengguna</h3>
        <button id="btnCloseDetail" type="button" aria-label="Tutup"
          class="grid h-8 w-8 place-items-center rounded-full text-slate-400 hover:bg-slate-100">
          <i data-lucide="x" class="h-4 w-4"></i>
        </button>
      </div>
      <div class="space-y-3">
        <div class="flex items-center justify-between border-b border-slate-100 pb-2 text-sm">
          <span class="font-semibold text-slate-400">Nama</span>
          <span id="detailNama" class="font-semibold text-[var(--navy-900)]">-</span>
        </div>
        <div class="flex items-center justify-between border-b border-slate-100 pb-2 text-sm">
          <span class="font-semibold text-slate-400">Email</span>
          <span id="detailEmail" class="font-semibold text-[var(--navy-900)]">-</span>
        </div>
        <div class="flex items-center justify-between border-b border-slate-100 pb-2 text-sm">
          <span class="font-semibold text-slate-400">Role</span>
          <span id="detailRole" class="font-semibold text-[var(--navy-900)]">-</span>
        </div>
        <div class="flex items-center justify-between pb-2 text-sm">
          <span class="font-semibold text-slate-400">Status</span>
          <span id="detailStatus" class="font-semibold text-[var(--navy-900)]">-</span>
        </div>
      </div>
      <div class="mt-5 flex justify-end">
        <button type="button" id="btnEditDariDetail"
          class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-50">Edit</button>
      </div>
    </div>
  </div>
@endsection

@php
  $penggunaListJson = $users->map(fn($u) => [
    'id' => $u->id,
    'nama' => $u->name,
    'email' => $u->email,
    'role' => $u->role_name,
    'status' => $u->status,
  ]);
@endphp

@push('scripts')
  <script>
    $(function () {
      // ===== Data asli dari database (dikirim server saat halaman dimuat) =====
      let penggunaList = @json($penggunaListJson);
      const ROLE_LABEL = @json($roles);
      const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      const URL_STORE = "{{ route('admin.user.store') }}";
      const URL_UPDATE_BASE = "{{ url('admin/user') }}"; // + /{id}

      const PER_PAGE = 5;
      let currentPage = 1;
      let editingId = null;
      let detailActiveId = null;

      const $modalForm = $('#modalForm');
      const $modalDetail = $('#modalDetail');
      const $formError = $('#formError');

      function filteredData() {
        const role = $('#filterRole').val();
        const status = $('#filterStatus').val();
        const q = $('#searchPengguna').val().trim().toLowerCase();
        return penggunaList.filter((p) =>
          (!role || p.role === role) &&
          (!status || p.status === status) &&
          (!q || p.nama.toLowerCase().includes(q) || p.email.toLowerCase().includes(q))
        );
      }

      function renderTabel() {
        const data = filteredData();
        const totalData = data.length;
        const totalPage = Math.max(1, Math.ceil(totalData / PER_PAGE));
        if (currentPage > totalPage) currentPage = totalPage;
        const start = (currentPage - 1) * PER_PAGE;
        const pageData = data.slice(start, start + PER_PAGE);

        const $tbody = $('#tabelPengguna');
        if (pageData.length === 0) {
          $tbody.html(`<tr><td colspan="6" class="px-4 py-8 text-center text-sm text-slate-400">Tidak ada pengguna ditemukan.</td></tr>`);
        } else {
          $tbody.html(pageData.map((p, idx) => `
                  <tr class="hover:bg-slate-50">
                      <td class="px-4 py-3 text-slate-500">${start + idx + 1}</td>
                      <td class="px-4 py-3 font-semibold text-[var(--navy-900)]">${p.nama}</td>
                      <td class="px-4 py-3 text-slate-600">${p.email}</td>
                      <td class="px-4 py-3">
                          <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">${ROLE_LABEL[p.role] ?? p.role}</span>
                      </td>
                      <td class="px-4 py-3">
                          <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-bold ${p.status === 'aktif' ? 'bg-[var(--teal-500,#0d9488)]/10 text-[var(--teal-600,#0f766e)]' : 'bg-slate-100 text-slate-500'}">
                              <span class="h-1.5 w-1.5 rounded-full ${p.status === 'aktif' ? 'bg-[var(--teal-500,#0d9488)]' : 'bg-slate-400'}"></span>
                              ${p.status === 'aktif' ? 'Aktif' : 'Nonaktif'}
                          </span>
                      </td>
                      <td class="px-4 py-3">
                          <div class="flex items-center justify-end gap-1">
                              <button class="row-btn grid h-8 w-8 place-items-center rounded-lg text-slate-500 hover:bg-slate-100" data-aksi="lihat" data-id="${p.id}" aria-label="Detail"><i data-lucide="eye" class="h-4 w-4"></i></button>
                              <button class="row-btn grid h-8 w-8 place-items-center rounded-lg text-slate-500 hover:bg-slate-100" data-aksi="edit" data-id="${p.id}" aria-label="Edit"><i data-lucide="pencil" class="h-4 w-4"></i></button>
                              <button class="row-btn grid h-8 w-8 place-items-center rounded-lg text-[var(--coral-500,#e0665a)] hover:bg-red-50" data-aksi="hapus" data-id="${p.id}" aria-label="Hapus"><i data-lucide="trash-2" class="h-4 w-4"></i></button>
                          </div>
                      </td>
                  </tr>`).join(''));
        }

        $('#paginationInfo').text(
          totalData === 0 ? 'Showing 0 of 0' : `Showing ${start + 1}-${Math.min(start + PER_PAGE, totalData)} of ${totalData}`
        );
        renderPaginationBtns(totalPage);
        lucide.createIcons();
      }

      function renderPaginationBtns(totalPage) {
        const $wrap = $('#paginationBtns');
        let html = `<button id="pgPrev" aria-label="Sebelumnya" class="grid h-8 w-8 place-items-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="chevron-left" class="h-4 w-4"></i></button>`;
        for (let p = 1; p <= totalPage; p++) {
          html += `<button data-page="${p}" class="h-8 min-w-[2rem] rounded-lg px-2 text-sm font-semibold ${p === currentPage ? 'bg-[var(--navy-900)] text-white' : 'text-slate-500 hover:bg-slate-100'}">${p}</button>`;
        }
        html += `<button id="pgNext" aria-label="Berikutnya" class="grid h-8 w-8 place-items-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="chevron-right" class="h-4 w-4"></i></button>`;
        $wrap.html(html);
      }

      // ===== Event delegation (aman dipakai walau tabel/pagination re-render) =====
      $('#tabelPengguna').on('click', '[data-aksi="lihat"]', function () { bukaDetail(Number($(this).data('id'))); });
      $('#tabelPengguna').on('click', '[data-aksi="edit"]', function () { bukaForm(Number($(this).data('id'))); });
      $('#tabelPengguna').on('click', '[data-aksi="hapus"]', function () { hapusPengguna(Number($(this).data('id'))); });

      $('#paginationBtns').on('click', '[data-page]', function () {
        currentPage = Number($(this).data('page'));
        renderTabel();
      });
      $('#paginationBtns').on('click', '#pgPrev', function () {
        if (currentPage > 1) { currentPage--; renderTabel(); }
      });
      $('#paginationBtns').on('click', '#pgNext', function () {
        renderTabel(); // totalPage dicek ulang di dalam renderTabel via currentPage clamp
      });

      $('#filterRole, #filterStatus').on('change', function () { currentPage = 1; renderTabel(); });
      $('#searchPengguna').on('keyup', function () { currentPage = 1; renderTabel(); });

      function bukaForm(id) {
        editingId = id || null;
        $formError.hide();
        const data = id ? penggunaList.find((p) => p.id === id) : null;

        $('#modalFormTitle').text(id ? 'Edit Pengguna' : 'Tambah Pengguna');
        $('#inputNama').val(data ? data.nama : '');
        $('#inputEmail').val(data ? data.email : '');
        $('#inputPassword').val('').prop('required', !id);
        $('#hintPassword').toggle(!!id);
        $('#inputRole').val(data ? data.role : 'student');
        $('input[name="statusPengguna"]').each(function () {
          $(this).prop('checked', $(this).val() === (data ? data.status : 'aktif'));
        });

        $modalForm.removeClass('hidden').addClass('flex');
      }

      function tutupForm() {
        $modalForm.removeClass('flex').addClass('hidden');
        editingId = null;
        $('#formPengguna')[0].reset();
      }

      $('#btnTambah').on('click', () => bukaForm(null));
      $('#btnCloseForm, #btnBatalForm').on('click', tutupForm);
      $modalForm.on('click', function (e) { if (e.target === this) tutupForm(); });

      $('#btnTogglePw').on('click', function () {
        const $inp = $('#inputPassword');
        $inp.attr('type', $inp.attr('type') === 'password' ? 'text' : 'password');
      });

      $('#formPengguna').on('submit', function (e) {
        e.preventDefault();
        $formError.hide();

        const payload = {
          name: $('#inputNama').val().trim(),
          email: $('#inputEmail').val().trim(),
          password: $('#inputPassword').val(),
          role_name: $('#inputRole').val(),
          status: $('input[name="statusPengguna"]:checked').val() || 'aktif',
        };

        const $btnSimpan = $('#btnSimpanForm');
        $btnSimpan.prop('disabled', true);

        const url = editingId ? `${URL_UPDATE_BASE}/${editingId}` : URL_STORE;
        const method = editingId ? 'PUT' : 'POST';

        $.ajax({
          url,
          method,
          contentType: 'application/json',
          headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
          data: JSON.stringify(payload),
        }).done(function (result) {
          const savedUser = {
            id: result.user.id,
            nama: result.user.name,
            email: result.user.email,
            role: result.user.role_name,
            status: result.user.status,
          };

          if (editingId) {
            const idx = penggunaList.findIndex((p) => p.id === editingId);
            if (idx > -1) penggunaList[idx] = savedUser;
          } else {
            penggunaList.push(savedUser);
          }

          tampilkanToast(result.message);
          tutupForm();
          renderTabel();
        }).fail(function (xhr) {
          const result = xhr.responseJSON || {};
          if (result.errors) {
            $formError.text(Object.values(result.errors).flat().join(' '));
          } else {
            $formError.text(result.message || 'Terjadi kesalahan, silakan coba lagi.');
          }
          $formError.show();
        }).always(function () {
          $btnSimpan.prop('disabled', false);
        });
      });

      function bukaDetail(id) {
        const p = penggunaList.find((x) => x.id === id);
        if (!p) return;
        detailActiveId = id;
        $('#detailNama').text(p.nama);
        $('#detailEmail').text(p.email);
        $('#detailRole').text(ROLE_LABEL[p.role] ?? p.role);
        $('#detailStatus').text(p.status === 'aktif' ? 'Aktif' : 'Nonaktif');
        $modalDetail.removeClass('hidden').addClass('flex');
      }

      $('#btnCloseDetail').on('click', () => $modalDetail.removeClass('flex').addClass('hidden'));
      $modalDetail.on('click', function (e) { if (e.target === this) $modalDetail.removeClass('flex').addClass('hidden'); });
      $('#btnEditDariDetail').on('click', function () {
        const id = detailActiveId;
        $modalDetail.removeClass('flex').addClass('hidden');
        bukaForm(id);
      });

      function hapusPengguna(id) {
        const p = penggunaList.find((x) => x.id === id);
        if (!p) return;
        if (!confirm(`Hapus pengguna "${p.nama}"?`)) return;

        $.ajax({
          url: `${URL_UPDATE_BASE}/${id}`,
          method: 'DELETE',
          headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
        }).done(function (result) {
          penggunaList = penggunaList.filter((x) => x.id !== id);
          tampilkanToast(result.message);
          renderTabel();
        }).fail(function (xhr) {
          const result = xhr.responseJSON || {};
          tampilkanToast(result.message || 'Gagal menghapus pengguna.');
        });
      }

      renderTabel();
    });
  </script>
@endpush