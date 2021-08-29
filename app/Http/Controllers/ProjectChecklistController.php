<?php

namespace App\Http\Controllers;

use App\Models\CheckItem;
use App\Models\ProjectChecklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->row as $index => $r) {
            DB::update('update check_items set inspection_item = ? , status = ? , comment = ?  where id = ?', [$r["inspection_item"], $r['status'], $r['comment'], $r['id']]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectChecklist  $projectChecklist
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectChecklist $projectChecklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectChecklist  $projectChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectChecklist $projectChecklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectChecklist  $projectChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectChecklist $projectChecklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectChecklist  $projectChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectChecklist $projectChecklist)
    {
        //
    }

    public function add_checkitem(Request $request)
    {
        $checklist = ProjectChecklist::find($request->checklist_id);
        $checkitem = CheckItem::create(
            $request->all()
        );
        $html = $this->checkitems_html($checklist);
        return response()->json(['html' => $html]);
    }
    public function get_all_checkitems(Request $request)
    {
        $checklist = ProjectChecklist::find($request->checklist_id);
        $html = $this->checkitems_html($checklist);
        return response()->json(['html' => $html]);
    }

    public function checkitems_html($checklist)
    {
        $html = '';
        foreach ($checklist->items as $index => $item) {
            $inspection_item = $item["inspection_item"];
            $row_num = $index + 1;
            $inspection_id = $item["id"];
            $checked_yes = $item['status'] == "YES"  ? 'checked' : '';
            $checked_no = $item['status'] == "NO"  ? 'checked' : '';
            $checked_na = $item['status'] == "N/A"  ? 'checked' : '';
            $comment = $item['comment'];
            $disabled = $checklist->status == 'pending' ? 'disabled' : '';
            $html .= "<tr>
            <td rowspan=\"2\" class=\"text-center border border-b-gray-400\">
                $row_num
            </td>
            <td class=\"border\">
                <input class=\"border-none w-full h-full\" value=\"$inspection_item\" autocomplete=\"off\" name=\"row[$inspection_id][inspection_item]\" required $disabled>
            </td>
            <td class=\"border py-2 text-center\"><input type=\"radio\" autocomplete=\"off\" name=\"row[$inspection_id][status]\" required $disabled
                    value=\"YES\" $checked_yes id=\"\"></td>
            <td class=\"border py-2 text-center\"><input type=\"radio\" autocomplete=\"off\" name=\"row[$inspection_id][status]\" required $disabled
                    value=\"NO\" $checked_no id=\"\"></td>
            <td class=\"border py-2 text-center\"><input type=\"radio\" autocomplete=\"off\" name=\"row[$inspection_id][status]\" required $disabled
                    value=\"N/A\" $checked_na id=\"\"></td>
                    </tr>
                    <tr>
                    <td colspan=\"4\" class=\"border-b border-gray-400\">
                    <input type=\"text\" autocomplete=\"off\" name=\"row[$inspection_id][comment]\" id=\"\"
                    class=\"w-full h-full border-none\" placeholder=\"الملاحظات\" value=\"$comment\" $disabled>
                </td>
            </tr>
            <input type=\"hidden\" value=\"$inspection_id\" name=\"row[$inspection_id][id]\" required />
            ";
        }
        return $html;
    }

    public function request_approval_from_supervisor(Request $request)
    {
        $checklist = ProjectChecklist::find($request->checklist_id);
        $checklist->status = 'pending';
        $checklist->save();
        return redirect()->back();
    }

    public function approve_checklist(Request $request)
    {
        $checklist = ProjectChecklist::find($request->checklist_id);
        $checklist->status = 'approved_' . auth()->user()->role->name;
        $checklist->save();
        return redirect()->back();
    }
    public function decline_checklist(Request $request)
    {
        $checklist = ProjectChecklist::find($request->checklist_id);
        $checklist->status = 'declined_' . auth()->user()->role->name;
        $checklist->save();
        return redirect()->back();
    }
}
