@extends('admin.layouts.app')

@section('title', 'Pengaturan Website')

@push('styles')
    <style>
        .settings-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .settings-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.75rem 0.75rem 0 0 !important;
            border: none;
            padding: 1rem 1.25rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            padding: 0.75rem;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 0.5rem;
            border: 2px solid #e5e7eb;
            object-fit: cover;
        }

        .upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: #667eea;
            background-color: #f8faff;
        }

        .upload-area.dragover {
            border-color: #667eea;
            background-color: #f0f4ff;
        }

        .nav-pills .nav-link {
            border-radius: 0.5rem;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
                @csrf
                @method('PUT')

                <!-- Navigation Tabs -->
                <ul class="nav nav-pills mb-4" id="settingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="hero-tab" data-bs-toggle="pill" data-bs-target="#hero"
                            type="button" role="tab">
                            <i class="fas fa-home me-2"></i>Hero Section
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="couple-tab" data-bs-toggle="pill" data-bs-target="#couple"
                            type="button" role="tab">
                            <i class="fas fa-heart me-2"></i>Pasangan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="event-tab" data-bs-toggle="pill" data-bs-target="#event" type="button"
                            role="tab">
                            <i class="fas fa-calendar me-2"></i>Acara
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="quote-tab" data-bs-toggle="pill" data-bs-target="#quote" type="button"
                            role="tab">
                            <i class="fas fa-quote-right me-2"></i>Kutipan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact"
                            type="button" role="tab">
                            <i class="fas fa-phone me-2"></i>Kontak
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="settingsTabContent">
                    <!-- Hero Section -->
                    <div class="tab-pane fade show active" id="hero" role="tabpanel">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-home me-2"></i>Pengaturan Hero Section</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hero_title" class="form-label">Judul Utama</label>
                                            <input type="text" class="form-control" id="hero_title"
                                                name="settings[hero_title]"
                                                value="{{ $settings['hero_title'] ?? 'The Wedding Of' }}"
                                                placeholder="The Wedding Of">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hero_subtitle" class="form-label">Sub Judul</label>
                                            <input type="text" class="form-control" id="hero_subtitle"
                                                name="settings[hero_subtitle]"
                                                value="{{ $settings['hero_subtitle'] ?? '' }}" placeholder="Nama Pasangan">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="hero_description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="hero_description" name="settings[hero_description]" rows="3"
                                        placeholder="Deskripsi singkat tentang pernikahan">{{ $settings['hero_description'] ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Gambar Hero</label>
                                    @if (!empty($settings['hero_image']))
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($settings['hero_image']) }}" alt="Hero Image"
                                                class="image-preview">
                                        </div>
                                    @endif
                                    <div class="upload-area" onclick="document.getElementById('hero_image').click()">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                        <p class="mb-0">Klik untuk memilih gambar atau drag & drop</p>
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                    </div>
                                    <input type="file" class="d-none" id="hero_image" name="settings[hero_image]"
                                        accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Couple Section -->
                    <div class="tab-pane fade" id="couple" role="tabpanel">
                        <div class="row">
                            <!-- Groom -->
                            <div class="col-md-6">
                                <div class="card settings-card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="fas fa-male me-2"></i>Mempelai Pria</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="groom_name" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="groom_name"
                                                name="settings[groom_name]" value="{{ $settings['groom_name'] ?? '' }}"
                                                placeholder="Nama lengkap mempelai pria">
                                        </div>

                                        <div class="mb-3">
                                            <label for="groom_nickname" class="form-label">Nama Panggilan</label>
                                            <input type="text" class="form-control" id="groom_nickname"
                                                name="settings[groom_nickname]"
                                                value="{{ $settings['groom_nickname'] ?? '' }}"
                                                placeholder="Nama panggilan">
                                        </div>

                                        <div class="mb-3">
                                            <label for="groom_parents" class="form-label">Nama Orang Tua</label>
                                            <input type="text" class="form-control" id="groom_parents"
                                                name="settings[groom_parents]"
                                                value="{{ $settings['groom_parents'] ?? '' }}"
                                                placeholder="Nama Ayah & Nama Ibu">
                                        </div>

                                        <div class="mb-3">
                                            <label for="groom_address" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="groom_address" name="settings[groom_address]" rows="2"
                                                placeholder="Alamat mempelai pria">{{ $settings['groom_address'] ?? '' }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="groom_instagram" class="form-label">Instagram</label>
                                            <input type="text" class="form-control" id="groom_instagram"
                                                name="settings[groom_instagram]"
                                                value="{{ $settings['groom_instagram'] ?? '' }}" placeholder="@username">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Foto Mempelai Pria</label>
                                            @if (!empty($settings['groom_photo']))
                                                <div class="mb-2">
                                                    <img src="{{ Storage::url($settings['groom_photo']) }}"
                                                        alt="Groom Photo" class="image-preview">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="settings[groom_photo]"
                                                accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bride -->
                            <div class="col-md-6">
                                <div class="card settings-card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="fas fa-female me-2"></i>Mempelai Wanita</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="bride_name" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="bride_name"
                                                name="settings[bride_name]" value="{{ $settings['bride_name'] ?? '' }}"
                                                placeholder="Nama lengkap mempelai wanita">
                                        </div>

                                        <div class="mb-3">
                                            <label for="bride_nickname" class="form-label">Nama Panggilan</label>
                                            <input type="text" class="form-control" id="bride_nickname"
                                                name="settings[bride_nickname]"
                                                value="{{ $settings['bride_nickname'] ?? '' }}"
                                                placeholder="Nama panggilan">
                                        </div>

                                        <div class="mb-3">
                                            <label for="bride_parents" class="form-label">Nama Orang Tua</label>
                                            <input type="text" class="form-control" id="bride_parents"
                                                name="settings[bride_parents]"
                                                value="{{ $settings['bride_parents'] ?? '' }}"
                                                placeholder="Nama Ayah & Nama Ibu">
                                        </div>

                                        <div class="mb-3">
                                            <label for="bride_address" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="bride_address" name="settings[bride_address]" rows="2"
                                                placeholder="Alamat mempelai wanita">{{ $settings['bride_address'] ?? '' }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="bride_instagram" class="form-label">Instagram</label>
                                            <input type="text" class="form-control" id="bride_instagram"
                                                name="settings[bride_instagram]"
                                                value="{{ $settings['bride_instagram'] ?? '' }}" placeholder="@username">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Foto Mempelai Wanita</label>
                                            @if (!empty($settings['bride_photo']))
                                                <div class="mb-2">
                                                    <img src="{{ Storage::url($settings['bride_photo']) }}"
                                                        alt="Bride Photo" class="image-preview">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" name="settings[bride_photo]"
                                                accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Section -->
                    <div class="tab-pane fade" id="event" role="tabpanel">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-calendar me-2"></i>Informasi Acara</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="event_date" class="form-label">Tanggal Acara</label>
                                            <input type="date" class="form-control" id="event_date"
                                                name="settings[event_date]" value="{{ $settings['event_date'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="event_time" class="form-label">Waktu Mulai</label>
                                            <input type="time" class="form-control" id="event_time"
                                                name="settings[event_time]" value="{{ $settings['event_time'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="event_end_time" class="form-label">Waktu Selesai</label>
                                            <input type="time" class="form-control" id="event_end_time"
                                                name="settings[event_end_time]"
                                                value="{{ $settings['event_end_time'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="event_venue" class="form-label">Nama Tempat</label>
                                            <input type="text" class="form-control" id="event_venue"
                                                name="settings[event_venue]" value="{{ $settings['event_venue'] ?? '' }}"
                                                placeholder="Nama gedung/tempat acara">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="event_dress_code" class="form-label">Dress Code</label>
                                            <input type="text" class="form-control" id="event_dress_code"
                                                name="settings[event_dress_code]"
                                                value="{{ $settings['event_dress_code'] ?? '' }}"
                                                placeholder="Contoh: Formal, Casual, dll">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="event_address" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" id="event_address" name="settings[event_address]" rows="3"
                                        placeholder="Alamat lengkap tempat acara">{{ $settings['event_address'] ?? '' }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="event_map_url" class="form-label">Link Google Maps</label>
                                            <input type="url" class="form-control" id="event_map_url"
                                                name="settings[event_map_url]"
                                                value="{{ $settings['event_map_url'] ?? '' }}"
                                                placeholder="https://maps.google.com/...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="event_parking_info" class="form-label">Info Parkir</label>
                                            <input type="text" class="form-control" id="event_parking_info"
                                                name="settings[event_parking_info]"
                                                value="{{ $settings['event_parking_info'] ?? '' }}"
                                                placeholder="Informasi parkir">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quote Section -->
                    <div class="tab-pane fade" id="quote" role="tabpanel">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-quote-right me-2"></i>Kutipan & Pesan</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="home_quote" class="form-label">Kutipan Utama</label>
                                    <textarea class="form-control" id="home_quote" name="settings[home_quote]" rows="4"
                                        placeholder="Masukkan kutipan inspiratif atau ayat suci">{{ $settings['home_quote'] ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="home_quote_source" class="form-label">Sumber Kutipan</label>
                                    <input type="text" class="form-control" id="home_quote_source"
                                        name="settings[home_quote_source]"
                                        value="{{ $settings['home_quote_source'] ?? '' }}"
                                        placeholder="Contoh: QS. Ar-Rum Ayat 21">
                                </div>

                                <div class="mb-3">
                                    <label for="welcome_message" class="form-label">Pesan Selamat Datang</label>
                                    <textarea class="form-control" id="welcome_message" name="settings[welcome_message]" rows="3"
                                        placeholder="Pesan selamat datang untuk tamu">{{ $settings['welcome_message'] ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="thank_you_message" class="form-label">Pesan Terima Kasih</label>
                                    <textarea class="form-control" id="thank_you_message" name="settings[thank_you_message]" rows="3"
                                        placeholder="Pesan terima kasih untuk tamu">{{ $settings['thank_you_message'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="tab-pane fade" id="contact" role="tabpanel">
                        <div class="card settings-card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Informasi Kontak</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_1" class="form-label">Contact Person 1</label>
                                            <input type="text" class="form-control" id="contact_person_1"
                                                name="settings[contact_person_1]"
                                                value="{{ $settings['contact_person_1'] ?? '' }}" placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_phone_1" class="form-label">Nomor Telepon 1</label>
                                            <input type="text" class="form-control" id="contact_phone_1"
                                                name="settings[contact_phone_1]"
                                                value="{{ $settings['contact_phone_1'] ?? '' }}"
                                                placeholder="08xxxxxxxxxx">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_2" class="form-label">Contact Person 2</label>
                                            <input type="text" class="form-control" id="contact_person_2"
                                                name="settings[contact_person_2]"
                                                value="{{ $settings['contact_person_2'] ?? '' }}" placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_phone_2" class="form-label">Nomor Telepon 2</label>
                                            <input type="text" class="form-control" id="contact_phone_2"
                                                name="settings[contact_phone_2]"
                                                value="{{ $settings['contact_phone_2'] ?? '' }}"
                                                placeholder="08xxxxxxxxxx">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="contact_email"
                                                name="settings[contact_email]"
                                                value="{{ $settings['contact_email'] ?? '' }}"
                                                placeholder="email@domain.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_website" class="form-label">Website</label>
                                            <input type="url" class="form-control" id="contact_website"
                                                name="settings[contact_website]"
                                                value="{{ $settings['contact_website'] ?? '' }}"
                                                placeholder="https://website.com">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i>Simpan Semua Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Image preview functionality
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Drag and drop functionality
        document.querySelectorAll('.upload-area').forEach(area => {
            area.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            area.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });

            area.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const input = this.nextElementSibling;
                    input.files = files;
                }
            });
        });

        // Form validation
        document.getElementById('settingsForm').addEventListener('submit', function(e) {
            const requiredFields = ['hero_title', 'groom_name', 'bride_name', 'event_date'];
            let isValid = true;

            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi!');
            }
        });

        // Auto-save functionality (optional)
        let autoSaveTimeout;
        document.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(() => {
                    // Auto-save logic here if needed
                    console.log('Auto-saving...');
                }, 2000);
            });
        });

        // Character counter for textarea
        document.querySelectorAll('textarea').forEach(textarea => {
            const maxLength = textarea.getAttribute('maxlength');
            if (maxLength) {
                const counter = document.createElement('small');
                counter.className = 'form-text text-muted';
                counter.innerHTML = `<span class="current">0</span>/${maxLength} karakter`;
                textarea.parentNode.appendChild(counter);

                textarea.addEventListener('input', function() {
                    const current = this.value.length;
                    counter.querySelector('.current').textContent = current;
                });
            }
        });

        // Smooth scrolling for validation errors
        function scrollToError() {
            const firstError = document.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                firstError.focus();
            }
        }
    </script>
@endpush
