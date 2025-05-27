<?php

namespace App\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //\Log::info('Login attempt:', $credentials);
        //\Log::info('Success: ' . (int) $this->userService->login($credentials['email'], $credentials['password']));

        if ($this->userService->login($credentials['email'], $credentials['password'])) {

            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = $this->userService->register($data['name'], $data['email'], $data['password']);

        //\Log::info('Register attempt:', (array)$user);

        Auth::login($user); // Auto login after registration

        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'Account created and logged in successfully.');
    }

    /**
     * @param Request $request
     * @return Foundation\Application|Redirector|Application|RedirectResponse
     */
    public function logout(Request $request): Foundation\Application|Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }

    /**
     * @return Factory|Foundation\Application|View|\Illuminate\View\View|Application
     */
    public function showLoginForm(): Factory|Foundation\Application|View|\Illuminate\View\View|Application
    {
        return view('user.login');
    }

    /**
     * @return Factory|Foundation\Application|View|\Illuminate\View\View|Application
     */
    public function showRegistrationForm(): Factory|Foundation\Application|View|\Illuminate\View\View|Application
    {
        return view('user.register');
    }
}
