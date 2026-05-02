
namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index() {
        $vendors = Vendor::all();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
        'nama_vendor' => 'required|string|max:255',
        'merk' => 'required|string|max:255',
        'kontak' => 'nullable|string|max:255',
    ]);

    // Gunakan $validated, jangan $request->all()
    Vendor::create($validated);

    return redirect()->back()->with('success', 'Vendor berhasil ditambahkan!');
    }

    public function update(Request $request, Vendor $vendor) {
        $request->validate(['nama_vendor' => 'required', 'merk' => 'required']);
        $vendor->update($request->all());
        return redirect()->back()->with('success', 'Data Vendor berhasil diperbarui');
    }

    public function destroy(Vendor $vendor) {
        $vendor->delete();
        return redirect()->back()->with('success', 'Data Vendor berhasil dihapus');
    }
}
