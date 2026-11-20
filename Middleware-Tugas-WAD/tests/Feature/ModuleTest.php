<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Area;
use App\Models\User;
class ModuleTest extends TestCase {
    use RefreshDatabase;
    private function payload(): array { return ['nama_area'=>'Area Uji','nomor_lantai'=>2,'ada_stopkontak'=>1,'ada_wifi'=>1,'ketersediaan_area'=>'tersedia']; }
    public function test_public_can_read_and_create_but_cannot_edit_or_delete(): void {
        $this->get('/')->assertOk();
        $this->post('/area',$this->payload())->assertRedirect('/');
        $area=Area::firstOrFail();
        $this->get('/')->assertSee('Area Uji')->assertDontSee('Yakin hapus');
        $this->get('/area/'.$area->id_area.'/edit')->assertRedirect('/login');
        $this->put('/area/'.$area->id_area,$this->payload())->assertRedirect('/login');
        $this->delete('/area/'.$area->id_area)->assertRedirect('/login');
        $this->assertDatabaseCount('fasilitas_area',1);
    }
    public function test_login_update_checkbox_reset_delete_and_logout(): void {
        User::create(['username'=>'tester','password'=>'test-password','role'=>'admin']);
        $this->post('/login',['username'=>'tester','password'=>'wrong'])->assertSessionHasErrors('username');
        $this->assertGuest();
        $this->post('/login',['username'=>'tester','password'=>'test-password'])->assertRedirect('/');
        $this->assertAuthenticated();
        $area=Area::create($this->payload());
        $this->get('/area/'.$area->id_area.'/edit')->assertOk()->assertSee('Area Uji');
        $data=$this->payload(); $data['nama_area']='Area Baru'; unset($data['ada_wifi'],$data['ada_stopkontak']);
        $this->put('/area/'.$area->id_area,$data)->assertRedirect('/');
        $this->assertDatabaseHas('fasilitas_area',['id_area'=>$area->id_area,'nama_area'=>'Area Baru','ada_wifi'=>0,'ada_stopkontak'=>0]);
        $this->delete('/area/'.$area->id_area)->assertRedirect('/');
        $this->assertDatabaseCount('fasilitas_area',0);
        $this->post('/logout')->assertRedirect('/'); $this->assertGuest();
    }
    public function test_invalid_input_does_not_write_and_missing_area_is_404(): void {
        $this->post('/area',['nama_area'=>'','nomor_lantai'=>-1,'ketersediaan_area'=>'invalid'])->assertSessionHasErrors(['nama_area','nomor_lantai','ketersediaan_area']);
        $this->assertDatabaseCount('fasilitas_area',0);
        $user=User::create(['username'=>'tester','password'=>'test-password','role'=>'admin']);
        $this->actingAs($user)->get('/area/999/edit')->assertNotFound();
    }
}
