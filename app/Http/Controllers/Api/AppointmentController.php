<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return response()->json(Appointment::all());
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'email' => 'required|email',
            'appointment_time' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        // Create appointment with validated data
        $appointment = Appointment::create($validated);

        return response()->json($appointment, 201);
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return response()->json($appointment);
    }

   public function update(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->update($request->all());
    return response()->json($appointment);
}

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json(null, 204);
    }
    public function userAppointments(Request $request)
    {
        // Assuming the user is authenticated and has appointments
        $user = $request->user();
        $appointments = $user->appointments; // Assuming a relationship exists

        return response()->json($appointments);
    }
}
