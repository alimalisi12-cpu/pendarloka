<?php
$pageTitle = "Kelola Pengguna - Admin";
require_once BASE_PATH . '/views/layouts/header.php';

$currentAdminId = current_user()['id'] ?? 0;
$totalUsers = count($users);
$totalAdmins = count(array_filter($users, fn($u) => $u['role'] === 'admin'));
$totalRegularUsers = $totalUsers - $totalAdmins;
?>

<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Header & Breadcrumbs -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <a href="<?= base_url('admin') ?>" class="btn btn-white border rounded-circle me-3 shadow-sm" title="Kembali ke Dashboard">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h4 class="fw-bold text-dark m-0">Kelola Pengguna Platform</h4>
                    <p class="text-muted small m-0">Kelola data akun pengguna, atur role Superadmin, tambah user, dan reset kata sandi</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAddUser">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Pengguna Baru
                </button>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if ($flash = get_flash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $flash ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($flash = get_flash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $flash ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-4">
                <div class="card border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-primary-subtle text-primary rounded-3 me-3">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small">Total Pengguna</span>
                            <h4 class="fw-bold text-dark m-0"><?= $totalUsers ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-dark-subtle text-dark rounded-3 me-3">
                            <i class="bi bi-shield-lock-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small">Superadmin</span>
                            <h4 class="fw-bold text-dark m-0"><?= $totalAdmins ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-0 rounded-4 shadow-sm p-3 bg-white">
                    <div class="d-flex align-items-center">
                        <div class="p-3 bg-success-subtle text-success rounded-3 me-3">
                            <i class="bi bi-person-check-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small">User Reguler</span>
                            <h4 class="fw-bold text-dark m-0"><?= $totalRegularUsers ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pengguna -->
        <div class="card border-0 rounded-4 shadow-sm overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-muted">
                        <tr>
                            <th class="ps-4 py-3">Nama Pengguna</th>
                            <th>Email</th>
                            <th>WhatsApp</th>
                            <th>Role</th>
                            <th>Total Undangan</th>
                            <th>Terdaftar</th>
                            <th class="text-end pe-4">Aksi Pengelolaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <span class="p-2 bg-light rounded-circle me-3 text-primary fw-bold border" 
                                              style="width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center;">
                                            <?= strtoupper(substr($u['name'], 0, 1)) ?>
                                        </span>
                                        <div>
                                            <span class="fw-bold text-dark d-block"><?= htmlspecialchars($u['name']) ?></span>
                                            <?php if ($u['id'] == $currentAdminId): ?>
                                                <span class="badge bg-primary-subtle text-primary rounded-pill small" style="font-size: 0.65rem;">Akun Anda</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-monospace small text-dark"><?= htmlspecialchars($u['email']) ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($u['phone'])): ?>
                                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $u['phone']) ?>" target="_blank" class="text-success text-decoration-none small fw-semibold">
                                            <i class="bi bi-whatsapp me-1"></i> <?= htmlspecialchars($u['phone']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($u['role'] === 'admin'): ?>
                                        <span class="badge bg-dark rounded-pill px-3 py-1">Superadmin</span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border rounded-pill px-3 py-1">User</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1"><?= $u['total_events'] ?? 0 ?> Undangan</span>
                                </td>
                                <td class="text-muted small">
                                    <?= date('d M Y', strtotime($u['created_at'])) ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <!-- Edit User -->
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-circle btn-edit-user"
                                                title="Edit Profil Pengguna"
                                                data-id="<?= $u['id'] ?>"
                                                data-name="<?= htmlspecialchars($u['name'], ENT_QUOTES) ?>"
                                                data-email="<?= htmlspecialchars($u['email'], ENT_QUOTES) ?>"
                                                data-phone="<?= htmlspecialchars($u['phone'] ?? '', ENT_QUOTES) ?>"
                                                data-role="<?= $u['role'] ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <!-- Reset Password -->
                                        <button type="button" class="btn btn-outline-warning btn-sm rounded-circle btn-reset-password"
                                                title="Reset Password"
                                                data-id="<?= $u['id'] ?>"
                                                data-name="<?= htmlspecialchars($u['name'], ENT_QUOTES) ?>">
                                            <i class="bi bi-key"></i>
                                        </button>

                                        <!-- Hapus User -->
                                        <?php if ($u['id'] != $currentAdminId): ?>
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle btn-delete-user"
                                                    title="Hapus Pengguna"
                                                    data-id="<?= $u['id'] ?>"
                                                    data-name="<?= htmlspecialchars($u['name'], ENT_QUOTES) ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH USER -->
<div class="modal fade" id="modalAddUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <form action="<?= base_url('admin/users/save') ?>" method="POST">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="fw-bold text-dark m-0">
                        <i class="bi bi-person-plus text-primary me-2"></i> Tambah Pengguna Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <p class="text-muted small mb-3">Buat akun baru untuk user atau calon superadmin platform.</p>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Contoh: Budi Santoso" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Alamat Email</label>
                        <input type="email" name="email" class="form-control rounded-3" placeholder="nama@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">No. WhatsApp</label>
                        <input type="text" name="phone" class="form-control rounded-3" placeholder="081234567890">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Role / Hak Akses</label>
                        <select name="role" class="form-select rounded-3">
                            <option value="user" selected>Pengguna Biasa (User)</option>
                            <option value="admin">Superadmin (Akses Penuh Panel Admin)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Kata Sandi (Password)</label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="Minimal 6 karakter" required>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Buat Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT USER -->
<div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <form action="<?= base_url('admin/users/save') ?>" method="POST">
                <input type="hidden" name="id" id="editUserId">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="fw-bold text-dark m-0">
                        <i class="bi bi-pencil-square text-primary me-2"></i> Edit Data Pengguna
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Nama Lengkap</label>
                        <input type="text" name="name" id="editUserName" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Alamat Email</label>
                        <input type="email" name="email" id="editUserEmail" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">No. WhatsApp</label>
                        <input type="text" name="phone" id="editUserPhone" class="form-control rounded-3">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Role Akun</label>
                        <select name="role" id="editUserRole" class="form-select rounded-3">
                            <option value="user">Pengguna Biasa (User)</option>
                            <option value="admin">Superadmin (Akses Penuh)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL RESET PASSWORD -->
<div class="modal fade" id="modalResetPassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <form id="resetPasswordForm" method="POST">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="fw-bold text-dark m-0">
                        <i class="bi bi-key-fill text-warning me-2"></i> Reset Kata Sandi Pengguna
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <p class="text-muted small mb-3">
                        Set kata sandi baru untuk pengguna: <strong id="resetUserName" class="text-dark"></strong>
                    </p>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Kata Sandi Baru</label>
                        <input type="password" name="new_password" class="form-control rounded-3" placeholder="Minimal 6 karakter" required>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 fw-semibold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Ubah Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS USER -->
<div class="modal fade" id="modalDeleteUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-body text-center p-4">
                <div class="p-3 bg-danger-subtle text-danger rounded-circle d-inline-flex mb-3">
                    <i class="bi bi-trash3-fill fs-2"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Hapus Akun Pengguna?</h5>
                <p class="text-muted small mb-4">
                    Apakah Anda yakin ingin menghapus akun <strong id="deleteUserName" class="text-dark"></strong>? 
                    Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="deleteUserConfirmBtn" class="btn btn-danger rounded-pill px-4">
                        Ya, Hapus Pengguna
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit User
    const modalEditEl = document.getElementById('modalEditUser');
    const modalEdit = new bootstrap.Modal(modalEditEl);

    document.querySelectorAll('.btn-edit-user').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('editUserId').value = this.dataset.id;
            document.getElementById('editUserName').value = this.dataset.name;
            document.getElementById('editUserEmail').value = this.dataset.email;
            document.getElementById('editUserPhone').value = this.dataset.phone;
            document.getElementById('editUserRole').value = this.dataset.role;
            modalEdit.show();
        });
    });

    // Reset Password
    const modalResetEl = document.getElementById('modalResetPassword');
    const modalReset = new bootstrap.Modal(modalResetEl);

    document.querySelectorAll('.btn-reset-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById('resetUserName').textContent = name;
            document.getElementById('resetPasswordForm').action = '<?= base_url("admin/users/reset-password/") ?>' + id;
            modalReset.show();
        });
    });

    // Delete User
    const modalDeleteEl = document.getElementById('modalDeleteUser');
    const modalDelete = new bootstrap.Modal(modalDeleteEl);

    document.querySelectorAll('.btn-delete-user').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById('deleteUserName').textContent = name;
            document.getElementById('deleteUserConfirmBtn').href = '<?= base_url("admin/users/delete/") ?>' + id;
            modalDelete.show();
        });
    });
});
</script>

<?php require_once BASE_PATH . '/views/layouts/footer.php'; ?>
