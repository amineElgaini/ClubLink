<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Events.php';
// app/Controllers/EventController.php
class EventController extends Controller {
    public function index() {}                                   // list all events
    public function register($id) {
    Events::inscrire($id, $_SESSION['id']);
  }                             // student registers for event
    public function update($id) {}                               // update event (president)
    public function destroy($id) {}                              // delete event (president)
}
