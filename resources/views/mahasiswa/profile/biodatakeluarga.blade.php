@extends('layouts.navbar')

@section('content')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                Account Settings - Security
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-4">
            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link ml-0" href="account-profile.html">Biodata Mahasiswa</a>
                <a class="nav-link" href="{{ url('profile/keluarga') }}">Biodata Keluarga</a>
                <a class="nav-link active" href="account-security.html">Pengalaman Organisasi</a>
                <a class="nav-link" href="account-notifications.html">Riwayat Penyakit</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-lg-8">
                    <!-- Change password card-->
                    <div class="card mb-4">
                        <div class="card-header">Change Password</div>
                        <div class="card-body">
                            <form>
                                <!-- Form Group (current password)-->
                                <div class="form-group">
                                    <label class="small mb-1" for="currentPassword">Current Password</label>
                                    <input class="form-control" id="currentPassword" type="password" placeholder="Enter current password" />
                                </div>
                                <!-- Form Group (new password)-->
                                <div class="form-group">
                                    <label class="small mb-1" for="newPassword">New Password</label>
                                    <input class="form-control" id="newPassword" type="password" placeholder="Enter new password" />
                                </div>
                                <!-- Form Group (confirm password)-->
                                <div class="form-group">
                                    <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                    <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm new password" />
                                </div>
                                <button class="btn btn-primary" type="button">Save</button>
                            </form>
                        </div>
                    </div>
                    <!-- Security preferences card-->
                    <div class="card mb-4">
                        <div class="card-header">Security Preferences</div>
                        <div class="card-body">
                            <!-- Account privacy optinos-->
                            <h5 class="mb-1">Account Privacy</h5>
                            <p class="small text-muted">By setting your account to private, your profile information and posts will not be visible to users outside of your user groups.</p>
                            <form>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" id="radioPublic" type="radio" name="radioPrivacy" checked />
                                    <label class="custom-control-label" for="radioPublic">Public (posts are available to all users)</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" id="radioPrivate" type="radio" name="radioPrivacy" />
                                    <label class="custom-control-label" for="radioPrivate">Private (posts are available to only users in your groups)</label>
                                </div>
                            </form>
                            <hr class="my-4" />
                            <!-- Data sharing options-->
                            <h5 class="mb-1">Data Sharing</h5>
                            <p class="small text-muted">Sharing usage data can help us to improve our products and better serve our users as they navigation through our application. When you agree to share usage data with us, crash reports and usage analytics will be automatically sent to our development team for investigation.</p>
                            <form>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" id="radioUsageYes" type="radio" name="radioUsage" checked />
                                    <label class="custom-control-label" for="radioUsageYes">Yes, share data and crash reports with app developers</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" id="radioUsageNo" type="radio" name="radioUsage" />
                                    <label class="custom-control-label" for="radioUsageNo">No, limit my data sharing with app developers</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Two factor authentication card-->
                    <div class="card mb-4">
                        <div class="card-header">Two-Factor Authentication</div>
                        <div class="card-body">
                            <p>Add another level of security to your account by enabling two-factor authentication. We will send you a text message to verify your login attempts on unrecognized devices and browsers.</p>
                            <form>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" id="twoFactorOn" type="radio" name="radioUsage" checked />
                                        <label class="custom-control-label" for="twoFactorOn">On</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" id="twoFactorOff" type="radio" name="radioUsage" />
                                        <label class="custom-control-label" for="twoFactorOff">Off</label>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="small mb-1" for="twoFactorSMS">SMS Number</label>
                                    <input class="form-control" id="twoFactorSMS" type="tel" placeholder="Enter a phone number" value="555-123-4567" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Delete account card-->
                    <div class="card mb-4">
                        <div class="card-header">Delete Account</div>
                        <div class="card-body">
                            <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                            <button class="btn btn-danger-soft text-danger" type="button">I understand, delete my account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
