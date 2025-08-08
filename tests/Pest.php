<?php
use App\Models\User;
use App\Models\TreePlanting;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}
beforeEach(function () {
    // Create a test user
    $this->user = User::factory()->create(['email_verified_at' => now()]);
});

// Home Route
it('can access the home route without authentication', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
             ->assertViewIs('dashboard1');
});

// Dashboard Route
it('requires authentication and verification to access the dashboard', function () {
    // Unauthenticated access
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));

    // Authenticated but unverified
    $unverifiedUser = User::factory()->create(['email_verified_at' => null]);
    $response = $this->actingAs($unverifiedUser)->get(route('dashboard'));
    $response->assertRedirect(route('verification.notice'));

    // Authenticated and verified
    $response = $this->actingAs($this->user)->get(route('dashboard'));
    $response->assertOk()->assertViewIs('dashboard');
});

// Settings Routes
describe('Settings Routes', function () {
    it('redirects settings to settings/profile', function () {
        $response = $this->actingAs($this->user)->get('/settings');
        $response->assertRedirect(route('settings.profile'));
    });

    it('can access settings.profile route', function () {
        $response = $this->actingAs($this->user)->get(route('settings.profile'));
        $response->assertOk();
        // Note: Volt routes render Livewire components, so we check for a successful response
    });

    it('can access settings.password route', function () {
        $response = $this->actingAs($this->user)->get(route('settings.password'));
        $response->assertOk();
    });

    it('can access settings.appearance route', function () {
        $response = $this->actingAs($this->user)->get(route('settings.appearance'));
        $response->assertOk();
    });
});

// Institutions Resource Routes
describe('Institutions Resource Routes', function () {
    it('can access institutions index', function () {
        $response = $this->actingAs($this->user)->get(route('institutions.index'));
        $response->assertOk();
    });

    it('can access institutions create', function () {
        $response = $this->actingAs($this->user)->get(route('institutions.create'));
        $response->assertOk();
    });

    it('can store a new institution', function () {
        $response = $this->actingAs($this->user)->post(route('institutions.store'), [
            'name' => 'Test Institution',
            // Add other required fields based on your Institution model
        ]);
        $response->assertRedirect(route('institutions.index'));
    });

    it('restricts unauthenticated access to institutions', function () {
        $response = $this->get(route('institutions.index'));
        $response->assertRedirect(route('login'));
    });
});

// Plantings Resource Routes
describe('Plantings Resource Routes', function () {
    it('can access plantings index', function () {
        $response = $this->actingAs($this->user)->get(route('plantings.index'));
        $response->assertOk();
    });

    it('can access plantings create', function () {
        $response = $this->actingAs($this->user)->get(route('plantings.create'));
        $response->assertOk();
    });

    it('can store a new planting', function () {
        $response = $this->actingAs($this->user)->post(route('plantings.store'), [
            'name' => 'Test Planting',
            // Add other required fields based on your Planting model
        ]);
        $response->assertRedirect(route('plantings.index'));
    });

    it('can update growth stage', function () {
        $planting = TreePlanting::factory()->create();
        $response = $this->actingAs($this->user)->post(route('plantings.updateGrowthStage', $planting), [
            'growth_stage' => 'sapling',
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('plantings', [
            'id' => $planting->id,
            'growth_stage' => 'sapling',
        ]);
    });

    it('restricts unauthenticated access to plantings', function () {
        $response = $this->get(route('plantings.index'));
        $response->assertRedirect(route('login'));
    });
});

// Reports Route
it('can access reports index', function () {
    $response = $this->actingAs($this->user)->get(route('reports.index'));
    $response->assertOk();
});

it('restricts unauthenticated access to reports', function () {
    $response = $this->get(route('reports.index'));
    $response->assertRedirect(route('login'));
});