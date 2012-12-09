# Open Source SAP Calculator
Licence: GNU GPL Affero

## SAP
SAP is the UK Government’s Standard Assessment Procedure for Energy Rating of Dwellings produced by BRE the Building Research Establishment. The worksheet here is based on the 2012 draft version of the SAP workskeet: 
http://www.bre.co.uk/filelibrary/SAP/2012/Draft_SAP_2012_December_2011.pdf
http://www.bre.co.uk/sap2012/page.jsp?id=2759

SAP is one of the key tools for modeling the performance of buildings and then being able to investigate the effects of building fabric improvements such as better insulation and draught proofing. 

## Motivations
The SAP procedure and worksheet is described openly in the SAP specification pdf however to date there appears to be no open source web based implementations of the worksheet.

This is an effort to create such a worksheet so that we can do these calculations on our own homes, understand the calculations and be able to get the data in and out in the way that we may find most useful.

An online and open source form could also make the SAP worksheet more accessible to a wider audience, it would be easier to start doing the SAP calculations out of a general interest and we hope it will help motivate people to start considering the building fabric energy efficiency improvements that can have such a large impact in terms of reducing heating energy requirements and so building a sustainable world. 

## Emoncms integrations
By implementing the worksheet as a module within emoncms we could potentially link parts of the speadsheet to real monitoring data collected within emoncms and to other tools such as the energy stack module which gives an energy overview based on David MacKay's book sustainable energy without the hot air. Together these tools form a comprehensive home energy toolkit.

# Development

The worksheet is not yet complete we have reached section 9 of ... its quite a long form!
See development section below for details on how to help with development.

The initial plan is to create the worksheet in a rough and just functional form, nothing fancy to start with and to fill the form close reference to the SAP specification document will be needed in order to understand what the inputs are and to get the table data etc. In future version we can imagine there being options to automatically bring in the table data depending on your location, ability to minimize/maximimse sections, miss out and hide sections that are not applicable and so on.

The idea behind the initial approach for implementing the worksheet is to first convert the pdf worksheet into a 'descriptor' file type format, which is then parsed using php and javascript into a functioning form. The idea being that it is likely that as development goes on the implementation will need to change and a descriptor would make it easier to parse it into a different form at a later date. The descriptor can be used to build html or even javascript. The intention being to try and avoid the need to rewrite the form at a later stage when we discover it needs to be implemented slightly differently. Whether this will hold out to be true is an other matter, but hopefully it will.

The descriptor syntax also aims for easy of entry so is very minimal. For example to create a table with input boxes that are identifiable by the SAP worksheet numbering scheme the descriptor looks like this:

<
Number of sides on which dwelling is sheltered|(19)
>

This is parsed into:

<table>
<tr><td>Number of sides on which dwelling is sheltered</td><td><input id='(19)' type='text' /> (19)</td></tr>
</table>

The second main feature of the descriptor is the specification of equations, lets say (19)=(17)+(18), we write:

$ (19)=(17)+(18)

php converts this into an array and passes it to the javascript part: [{'result':'(19)', 'items':['(17)','x','(18)']}]
javascript then executes this equation automatically putting the result of the sum of the values entered in form input 17 and 18 into form input 19.

Here's the descriptor syntax so far:

hash - heading
p - paragraph
< - open table
> - close table
$ equation
t 0 - input labels in-line
t 1 - input labels below input box

If you would like to get involved with developing this, please get in contact on the OpenEnergyMonitor forums.

Thanks!
