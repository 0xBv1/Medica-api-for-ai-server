<x-profile title="Profile" >

              
    <div class="profile-container py-5">
        <h2 class="text-center mb-4">User Profile</h2>

        <div class="profile-section">
            <div class="row">
                <!-- Profile Photo + Upload Section -->
                <div class="col-md-4 text-center">
                    <img src="https://i.pravatar.cc/150?img=12" alt="Profile Photo" class="profile-img mb-3" />
                    <div>
                        <button class="btn-outline-primary btn-sm profile-upload-btn">Upload new photo</button>
                        <p class="profile-note mt-2">Allowed JPG or PNG. Max size of 2 MB</p>
                    </div>
                </div>

                <!-- Basic Information Section -->
                <div class="col-md-8">
                    <h5 class="profile-section-title">Basic Information</h5>

                    <div class="row mb-3">
                        <div class="col-sm-4 profile-info-label">Full Name:</div>
                        <div class="col-sm-8">{{ $user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 profile-info-label">Email:</div>
                        <div class="col-sm-8">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 profile-info-label">Gender:</div>
                        <div class="col-sm-8">{{ ucfirst($user->gender) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 profile-info-label">Age:</div>
                        <div class="col-sm-8">{{ $user->age }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 profile-info-label">Phone:</div>
                        <div class="col-sm-8">{{ $user->phone ?? '+20123456789' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 profile-info-label">Address:</div>
                        <div class="col-sm-8">{{ $user->address ?? 'Cairo, Egypt' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Smart Suggestions -->
        <div class="profile-section">
            <div class="profile-section-title">Smart Suggestions</div>
            <ul class="with-bullets">
                <li>Based on your history, consider uploading a new test every 3 months.</li>
                <li>Follow a diet rich in antioxidants.</li>
                <li>Maintain regular physical activity.</li>
            </ul>
        </div>

        <!-- Platform Activity -->
        <div class="profile-section">
            <div class="profile-section-title">Platform Activity</div>
            <ul class="with-bullets">
                <li>Last Diagnosis: 12/03/2025</li>
                <li>AI Tool Usage: 5 times</li>
                <li>Chatbot Interactions: 3 conversations</li>
            </ul>
        </div>

        @if($user->predictions->isEmpty())
        <p class="text-muted">No predictions available yet.</p>
        @else
        <p class="text-muted">Predictions History.</p>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Model</th>
                        <th>Prediction</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->predictions as $prediction)
                    <tr>
                        <td>{{ $prediction->aiModel->name ?? '-' }}</td>
                        <td>{{ ucfirst($prediction->prediction) }}</td>
                        <td>{{ $prediction->created_at ? $prediction->created_at->format('d/m/Y') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</x-profile>