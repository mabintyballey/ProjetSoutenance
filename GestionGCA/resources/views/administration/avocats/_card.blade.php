<div class="card mb-3 border-0 shadow-sm card-hover" style="min-height: 150px;">
    <div class="row g-0 align-items-center">
        <div class="col-md-3">
            <img src="{{ $avocat->photo ? asset('storage/' . $avocat->photo) : asset('uploads/photos/default.png') }}"
                class="img-fluid w-100" style="object-fit: contain; height: 150px;" alt="{{ $avocat->nom }} {{ $avocat->prenom }}">
        </div>
        <div class="col-md-9">
            <div class="card-body py-3 px-3 d-flex justify-content-between align-items-center flex-wrap">
                <div class="me-3" style="line-height: 1.2;">
                    <h5 class="fw-bold mb-1 text-primary" style="font-size: 1rem; color: #001F3D;">
                        {{ $avocat->nom }} {{ $avocat->prenom }}
                    </h5>
                    <p class="mb-1 text-muted fw-bold" style="font-size: 0.85rem;">
                        <i class="fas fa-certificate me-1"></i>
                        {{ $avocat->avocat && $avocat->avocat->specialite ? $avocat->avocat->specialite->nom : 'Aucune spécialité' }}
                    </p>
                    <small class="text-muted fw-bold" style="font-size: 0.8rem;">
                        <i class="fas fa-envelope me-1"></i>{{ $avocat->email }}
                    </small>
                </div>

                <div class="d-flex align-items-center gap-2 mt-3 mt-md-0 flex-wrap">
                    <span class="badge {{ $avocat->avocat && $avocat->avocat->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $avocat->avocat && $avocat->avocat->is_active ? 'Actif' : 'Inactif' }}
                    </span>

                    <button type="button"
                        class="btn btn-sm {{ $avocat->avocat && $avocat->avocat->is_active ? 'btn-warning' : 'btn-success' }}"
                        data-bs-toggle="modal" data-bs-target="#confirmToggleModal{{ $avocat->id }}">
                        {{ $avocat->avocat && $avocat->avocat->is_active ? 'Désactiver' : 'Activer' }}
                    </button>

                    <div class="dropdown">
                        <button class="btn btn-outline-warning btn-sm" data-bs-toggle="dropdown">
                            <i class="fas fa-cogs"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.avocats.show', $avocat->id) }}">
                                    <i class="fas fa-eye me-1"></i> Voir
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.avocats.edit', $avocat->id) }}">
                                    <i class="fas fa-edit me-1"></i> Modifier
                                </a>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item text-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal"
                                    onclick="setDeleteAction({{ $avocat->id }})">
                                    <i class="fas fa-trash-alt me-1"></i> Supprimer
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
